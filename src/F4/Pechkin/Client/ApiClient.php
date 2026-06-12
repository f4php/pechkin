<?php

declare(strict_types=1);

namespace F4\Pechkin\Client;

// Documentation: https://core.telegram.org/bots/api

use Throwable,
    F4\Pechkin\CanExpandDataTypesTrait,
    F4\Pechkin\Client\ClientException,
    F4\Pechkin\DataType\ResponseParameters,
    GuzzleHttp\Client as Guzzle,
    GuzzleHttp\Exception\RequestException
;
use function
    hrtime,
    is_array,
    json_decode,
    sleep,
    sprintf,
    usleep
;

class ApiClient
{
    use CanExpandDataTypesTrait;
    protected const string BASE_URL = 'https://api.telegram.org/bot';
    protected const string API_VERSION = '9.3';
    protected const int REQUEST_TIMEOUT = 60;

    private float $lastRequestAt = 0.0;

    public function __construct(
        protected readonly string $token,
        protected readonly int $throttleMs = 0, // minimum spacing between requests; 0 = no throttling
        protected readonly int $maxRetries = 0, // automatic retries on 429 honoring retry_after; 0 = no retries
        protected readonly int $maxRetryAfter = 60, // never auto-sleep longer than this; longer waits are the caller's decision
    ) {}

    public function sendJsonRequest(string $method, array $parameters = [], bool $compact = true): mixed
    {
        return $this->execute($method, [
            'connect_timeout' => static::REQUEST_TIMEOUT,
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
            ],
            'json' => self::expandAsArray(value: $parameters, compact: $compact),
        ]);
    }

    public function sendMultipartRequest(string $method, array $parameters = [], bool $compact = true): mixed
    {
        return $this->execute($method, [
            'connect_timeout' => static::REQUEST_TIMEOUT,
            'multipart' => self::expandAsMultipartFormData(value: $parameters, compact: $compact),
        ]);
    }

    protected function createHttpClient(): Guzzle
    {
        return new Guzzle();
    }

    protected function execute(string $method, array $requestOptions): mixed
    {
        $requestURL = sprintf(self::BASE_URL . '%s/%s', $this->token, $method);
        for ($attempt = 0; ; $attempt++) {
            $this->throttle();
            try {
                try {
                    $clientResponse = $this->createHttpClient()->request('POST', $requestURL, $requestOptions);
                    $responseBody = json_decode((string) $clientResponse->getBody(), true, JSON_THROW_ON_ERROR);
                    return match ($responseBody['ok'] ?? false) {
                        true => $responseBody['result'],
                        false => $this->throwError(body: $responseBody, fallbackCode: 500),
                    };
                }
                catch (RequestException $e) {
                    if ($e->hasResponse()) {
                        // HTTP-level errors (incl. 429) also carry the standard {"ok":false,...} body
                        $rawBody = (string) $e->getResponse()->getBody();
                        $this->throwError(
                            body: json_decode($rawBody, true) ?? $rawBody,
                            fallbackCode: $e->getCode(),
                            previous: $e,
                        );
                    }
                    throw new ClientException(message: $e->getMessage(), code: $e->getCode(), previous: $e);
                }
                catch (ClientException $e) {
                    throw $e;
                }
                catch (Throwable $e) {
                    throw new ClientException(message: $e->getMessage(), code: $e->getCode(), previous: $e);
                }
            }
            catch (ClientException $e) {
                $retryAfter = $e->parameters?->retry_after;
                if ($e->getCode() === 429 && $retryAfter !== null && $retryAfter <= $this->maxRetryAfter && $attempt < $this->maxRetries) {
                    sleep($retryAfter);
                    continue;
                }
                throw $e;
            }
        }
    }

    private function throwError(array|string $body, int $fallbackCode, ?Throwable $previous = null): never
    {
        if (is_array($body) && ($body['ok'] ?? null) === false) {
            throw new ClientException(
                message: $body['description'] ?? 'Unknown error',
                code: $body['error_code'] ?? $fallbackCode,
                previous: $previous,
                parameters: isset($body['parameters']) && is_array($body['parameters'])
                    ? ResponseParameters::fromArray($body['parameters'])
                    : null,
            );
        }
        throw new ClientException(
            message: is_array($body) ? ($body['description'] ?? 'Unknown error') : $body,
            code: $fallbackCode,
            previous: $previous,
        );
    }

    private function throttle(): void
    {
        if ($this->throttleMs <= 0) {
            return;
        }
        $now = hrtime(true) / 1e9;
        $waitSeconds = $this->throttleMs / 1000 - ($now - $this->lastRequestAt);
        if ($waitSeconds > 0) {
            usleep((int) ($waitSeconds * 1e6));
        }
        $this->lastRequestAt = hrtime(true) / 1e9;
    }
}
