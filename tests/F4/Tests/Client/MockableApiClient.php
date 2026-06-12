<?php

declare(strict_types=1);

namespace F4\Tests\Client;

use F4\Pechkin\Client\ApiClient;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

final class MockableApiClient extends ApiClient
{
    public function __construct(
        public readonly MockHandler $mockHandler,
        int $throttleMs = 0,
        int $maxRetries = 0,
    ) {
        parent::__construct(token: 'TEST:TOKEN', throttleMs: $throttleMs, maxRetries: $maxRetries);
    }

    protected function createHttpClient(): Guzzle
    {
        return new Guzzle(['handler' => HandlerStack::create($this->mockHandler)]);
    }
}
