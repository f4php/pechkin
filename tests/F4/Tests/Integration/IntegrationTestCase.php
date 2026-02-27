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
    protected static string $botId; // the Client requires string, not int

    /** Set when TELEGRAM_TEST_USER_ID is provided. Required for member management and sticker tests. */
    protected static ?int $userId = null;

    /** Set when TELEGRAM_BUSINESS_CONNECTION_ID is provided. Required for Business account tests. */
    protected static ?string $businessConnectionId = null;

    /** Set when TELEGRAM_PAYMENT_PROVIDER_TOKEN is provided. Required for payment tests. */
    protected static ?string $paymentProviderToken = null;

    public static function setUpBeforeClass(): void
    {
        $token = getenv('TELEGRAM_BOT_TOKEN');
        $chatId = getenv('TELEGRAM_TEST_CHAT_ID');

        if (!$token || !$chatId) {
            self::markTestSkipped(
                'Integration tests require TELEGRAM_BOT_TOKEN and TELEGRAM_TEST_CHAT_ID env vars'
            );
        }

        self::$client = new Client($token);
        self::$chatId = $chatId;

        $me = self::$client->getMe();
        self::$botId = $me->id;

        $userId = getenv('TELEGRAM_TEST_USER_ID');
        self::$userId = $userId ? (int) $userId : null;

        $businessId = getenv('TELEGRAM_BUSINESS_CONNECTION_ID');
        self::$businessConnectionId = $businessId ?: null;

        $paymentToken = getenv('TELEGRAM_PAYMENT_PROVIDER_TOKEN');
        self::$paymentProviderToken = $paymentToken ?: null;
    }

    /**
     * Skip the current test unless TELEGRAM_TEST_USER_ID was provided.
     * Call at the top of any test that operates on a real human user.
     */
    protected function skipUnlessUserId(): void
    {
        if (self::$userId === null) {
            $this->markTestSkipped('Requires TELEGRAM_TEST_USER_ID env var');
        }
    }

    /**
     * Skip unless TELEGRAM_BUSINESS_CONNECTION_ID was provided.
     */
    protected function skipUnlessBusinessId(): void
    {
        if (self::$businessConnectionId === null) {
            $this->markTestSkipped('Requires TELEGRAM_BUSINESS_CONNECTION_ID env var');
        }
    }

    /**
     * Skip unless TELEGRAM_PAYMENT_PROVIDER_TOKEN was provided.
     */
    protected function skipUnlessPaymentToken(): void
    {
        if (self::$paymentProviderToken === null) {
            $this->markTestSkipped('Requires TELEGRAM_PAYMENT_PROVIDER_TOKEN env var');
        }
    }

    /**
     * Assert that calling $callable throws a ClientException with a 4xx error code,
     * meaning the request was well-formed and reached Telegram but was rejected for
     * a business reason (e.g. missing permission) rather than failing due to a
     * serialization or network bug.
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
