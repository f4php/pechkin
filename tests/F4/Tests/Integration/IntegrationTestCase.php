<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\Client;
use F4\Pechkin\Client\ClientException;
use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    protected static Client $client;
    protected static string $chatId;
    protected static string $botId;
    protected static string $peerId;

    public static function setUpBeforeClass(): void
    {
        $token = getenv('TELEGRAM_BOT_TOKEN');
        $chatId = getenv('TELEGRAM_TEST_CHAT_ID');

        if (!$token || !$chatId) {
            self::markTestSkipped(
                'Integration tests require TELEGRAM_BOT_TOKEN and TELEGRAM_TEST_CHAT_ID  env vars'
            );
        }

        self::$client = new Client($token);
        self::$chatId = $chatId;

        // Resolve bot ID once for the suite
        $me = self::$client->getMe();
        self::$botId = $me->id;
    }

    /**
     * Assert that calling $callable throws a ClientException with a 4xx error code,
     * meaning the request was well-formed and reached Telegram but was rejected for
     * a business reason (e.g. fake ID, missing permission) rather than failing due
     * to a serialization or network bug.
     */
    protected function assertApiError(callable $callable, string $message = ''): void
    {
        try {
            $callable();
            $this->fail('Expected ClientException was not thrown. ' . $message);
        } catch (ClientException $e) {
            $this->assertGreaterThanOrEqual(
                400,
                $e->getCode(),
                'Expected a 4xx API error, got code ' . $e->getCode() . ': ' . $e->getMessage()
            );
            $this->assertLessThan(
                500,
                $e->getCode(),
                'Got a 5xx error — likely a serialization problem: ' . $e->getMessage()
            );
        }
    }
}
