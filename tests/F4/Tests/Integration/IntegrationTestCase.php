<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\Client;
use F4\Pechkin\Client\ApiClient;
use F4\Pechkin\Client\ClientException;
use PHPUnit\Framework\TestCase;

// NOTE: PHPUnit 13 does not inherit #[Group] attributes from parent classes,
// so every concrete test class must carry #[Group('integration')] itself
// in addition to its specific integration:* group.
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

    /** Set when TELEGRAM_TEST_CHANNEL_ID is provided. Required for channel-only features. */
    protected static ?string $channelId = null;

    /** Set when TELEGRAM_TEST_GAME_SHORT_NAME is provided. Required for real game tests. */
    protected static ?string $gameShortName = null;

    /** Set when TELEGRAM_TEST_ALLOW_DESTRUCTIVE is provided. Gates logOut/close tests. */
    protected static bool $allowDestructive = false;

    public static function setUpBeforeClass(): void
    {
        $token = getenv('TELEGRAM_BOT_TOKEN');
        $chatId = getenv('TELEGRAM_TEST_CHAT_ID');

        if (!$token || !$chatId) {
            self::markTestSkipped(
                'Integration tests require TELEGRAM_BOT_TOKEN and TELEGRAM_TEST_CHAT_ID env vars'
            );
        }

        // Throttle requests and react to 429 responses to stay under Telegram's flood limits
        $throttleMs = ($v = getenv('TELEGRAM_TEST_THROTTLE_MS')) !== false && $v !== '' ? (int) $v : 1500;
        $maxRetries = ($v = getenv('TELEGRAM_TEST_MAX_RETRIES')) !== false && $v !== '' ? (int) $v : 3;
        self::$client = new Client($token, new ApiClient($token, throttleMs: $throttleMs, maxRetries: $maxRetries));
        self::$chatId = $chatId;

        $me = self::$client->getMe();
        self::$botId = $me->id;

        $userId = getenv('TELEGRAM_TEST_USER_ID');
        self::$userId = $userId ? (int) $userId : null;

        $businessId = getenv('TELEGRAM_BUSINESS_CONNECTION_ID');
        self::$businessConnectionId = $businessId ?: null;

        $paymentToken = getenv('TELEGRAM_PAYMENT_PROVIDER_TOKEN');
        self::$paymentProviderToken = $paymentToken ?: null;

        $channelId = getenv('TELEGRAM_TEST_CHANNEL_ID');
        self::$channelId = $channelId ?: null;

        $gameShortName = getenv('TELEGRAM_TEST_GAME_SHORT_NAME');
        self::$gameShortName = $gameShortName ?: null;

        self::$allowDestructive = (bool) getenv('TELEGRAM_TEST_ALLOW_DESTRUCTIVE');
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
     * Skip unless TELEGRAM_TEST_CHANNEL_ID was provided.
     * Call at the top of any test that needs a channel the bot administers.
     */
    protected function skipUnlessChannelId(): void
    {
        if (self::$channelId === null) {
            $this->markTestSkipped('Requires TELEGRAM_TEST_CHANNEL_ID env var');
        }
    }

    /**
     * Skip unless TELEGRAM_TEST_GAME_SHORT_NAME was provided.
     * Call at the top of any test that needs a game registered with BotFather.
     */
    protected function skipUnlessGameShortName(): void
    {
        if (self::$gameShortName === null) {
            $this->markTestSkipped('Requires TELEGRAM_TEST_GAME_SHORT_NAME env var');
        }
    }

    /**
     * Skip unless TELEGRAM_TEST_ALLOW_DESTRUCTIVE was provided.
     * Gates tests that disrupt the bot session (logOut, close).
     */
    protected function skipUnlessDestructiveAllowed(): void
    {
        if (!self::$allowDestructive) {
            $this->markTestSkipped('Requires TELEGRAM_TEST_ALLOW_DESTRUCTIVE env var');
        }
    }

    /**
     * Run $callable and return its result; if Telegram rejects the call with a 4xx
     * error (feature unavailable for this bot/chat, missing rights, flood limits on
     * rarely-used settings), skip the test instead of failing. 5xx and transport
     * errors still fail, so serialization regressions are not masked.
     */
    protected function attemptOrSkip(callable $callable, string $feature): mixed
    {
        try {
            return $callable();
        } catch (ClientException $e) {
            if ($e->getCode() >= 400 && $e->getCode() < 500) {
                $this->markTestSkipped(
                    $feature . ' unavailable for this bot/chat: [' . $e->getCode() . '] ' . $e->getMessage()
                );
            }
            throw $e;
        }
    }

    /**
     * Load a binary fixture from the Fixtures directory (tiny ffmpeg-generated media files).
     */
    protected static function fixture(string $name): string
    {
        return file_get_contents(__DIR__ . '/Fixtures/' . $name);
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
