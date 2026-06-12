<?php

declare(strict_types=1);

namespace F4\Tests\Client;

use F4\Pechkin\Client\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

use function hrtime;
use function json_encode;

final class ApiClientTest extends TestCase
{
    private static function okResponse(mixed $result = true): Response
    {
        return new Response(200, [], json_encode(['ok' => true, 'result' => $result]));
    }

    private static function rateLimitResponse(int $retryAfter): Response
    {
        return new Response(429, [], json_encode([
            'ok' => false,
            'error_code' => 429,
            'description' => "Too Many Requests: retry after $retryAfter",
            'parameters' => ['retry_after' => $retryAfter],
        ]));
    }

    public function testSuccessfulRequestReturnsResult(): void
    {
        $client = new MockableApiClient(new MockHandler([self::okResponse(['id' => 42])]));
        $this->assertSame(['id' => 42], $client->sendJsonRequest('getMe'));
    }

    public function testRateLimitRetriesAndSucceeds(): void
    {
        $client = new MockableApiClient(
            new MockHandler([self::rateLimitResponse(0), self::okResponse('done')]),
            maxRetries: 3,
        );
        $this->assertSame('done', $client->sendJsonRequest('sendMessage'));
        $this->assertSame(0, $client->mockHandler->count(), 'both queued responses should be consumed');
    }

    public function testRateLimitThrowsWithParametersWhenRetriesDisabled(): void
    {
        $client = new MockableApiClient(new MockHandler([self::rateLimitResponse(43)]));
        try {
            $client->sendJsonRequest('sendMessage');
            $this->fail('Expected ClientException');
        } catch (ClientException $e) {
            $this->assertSame(429, $e->getCode());
            $this->assertSame('Too Many Requests: retry after 43', $e->getMessage());
            $this->assertNotNull($e->parameters);
            $this->assertSame(43, $e->parameters->retry_after);
        }
    }

    public function testRateLimitThrowsWhenRetriesExhausted(): void
    {
        $client = new MockableApiClient(
            new MockHandler([self::rateLimitResponse(0), self::rateLimitResponse(0), self::rateLimitResponse(7)]),
            maxRetries: 2,
        );
        try {
            $client->sendJsonRequest('sendMessage');
            $this->fail('Expected ClientException');
        } catch (ClientException $e) {
            $this->assertSame(429, $e->getCode());
            $this->assertSame(7, $e->parameters?->retry_after);
            $this->assertSame(0, $client->mockHandler->count(), 'all retries should be consumed');
        }
    }

    public function testOkFalseWithHttp200PopulatesParameters(): void
    {
        // some errors (e.g. group migration) arrive with HTTP 200 and ok:false
        $client = new MockableApiClient(new MockHandler([
            new Response(200, [], json_encode([
                'ok' => false,
                'error_code' => 400,
                'description' => 'Bad Request: group chat was upgraded to a supergroup chat',
                'parameters' => ['migrate_to_chat_id' => '-100123456789'],
            ])),
        ]));
        try {
            $client->sendJsonRequest('sendMessage');
            $this->fail('Expected ClientException');
        } catch (ClientException $e) {
            $this->assertSame(400, $e->getCode());
            $this->assertSame('-100123456789', $e->parameters?->migrate_to_chat_id);
        }
    }

    public function testHttpErrorWithoutParametersKeepsDescription(): void
    {
        $client = new MockableApiClient(new MockHandler([
            new Response(404, [], json_encode([
                'ok' => false,
                'error_code' => 404,
                'description' => 'Not Found',
            ])),
        ]));
        try {
            $client->sendJsonRequest('nonexistentMethod');
            $this->fail('Expected ClientException');
        } catch (ClientException $e) {
            $this->assertSame(404, $e->getCode());
            $this->assertSame('Not Found', $e->getMessage());
            $this->assertNull($e->parameters);
        }
    }

    public function testNonJsonErrorBodyFallsBackToRawBody(): void
    {
        $client = new MockableApiClient(new MockHandler([new Response(502, [], 'Bad Gateway')]));
        try {
            $client->sendJsonRequest('getMe');
            $this->fail('Expected ClientException');
        } catch (ClientException $e) {
            $this->assertSame(502, $e->getCode());
            $this->assertSame('Bad Gateway', $e->getMessage());
        }
    }

    public function testThrottleSpacesConsecutiveRequests(): void
    {
        $client = new MockableApiClient(
            new MockHandler([self::okResponse(), self::okResponse()]),
            throttleMs: 200,
        );
        $start = hrtime(true);
        $client->sendJsonRequest('getMe');
        $client->sendJsonRequest('getMe');
        $elapsedMs = (hrtime(true) - $start) / 1e6;
        $this->assertGreaterThanOrEqual(190, $elapsedMs, 'second request should be throttled');
    }
}
