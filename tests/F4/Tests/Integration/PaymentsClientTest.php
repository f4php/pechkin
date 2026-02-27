<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\DataType\{
    Message,
    OwnedGifts,
    StarTransactions,
};
use PHPUnit\Framework\Attributes\{
    Depends,
    Group,
};

/**
 * Tests for payment, Stars, invoice, and gift methods.
 *
 * Requires:
 *   TELEGRAM_BOT_TOKEN            — the bot token
 *   TELEGRAM_TEST_CHAT_ID         — a chat the bot is in
 *   TELEGRAM_PAYMENT_PROVIDER_TOKEN — a Telegram payment provider token
 *                                    (e.g. Stripe test token from @BotFather)
 *
 * Run with:
 *   TELEGRAM_PAYMENT_PROVIDER_TOKEN=xxx composer test:integration:payments
 *
 * Note: Stars transactions (getMyStarBalance, getStarTransactions) are also
 * available in the main ClientTest as read-only tests that need no token.
 * The tests here focus on write operations that require a provider token.
 */
#[Group('integration:payments')]
final class PaymentsClientTest extends IntegrationTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::skipUnlessPaymentTokenStatic();
    }

    private static function skipUnlessPaymentTokenStatic(): void
    {
        if (self::$paymentProviderToken === null) {
            self::markTestSkipped('Requires TELEGRAM_PAYMENT_PROVIDER_TOKEN env var');
        }
    }

    // -------------------------------------------------------------------------
    // Invoice lifecycle
    // -------------------------------------------------------------------------

    public function testCreateInvoiceLink(): string
    {
        $link = self::$client->createInvoiceLink(
            title: 'Integration Test Product',
            description: 'Pechkin integration test invoice',
            payload: 'integration_test_payload',
            currency: 'USD',
            prices: [['label' => 'Item', 'amount' => 100]],
            provider_token: self::$paymentProviderToken,
        );

        $this->assertIsString($link);
        $this->assertStringStartsWith('https://t.me/', $link);

        return $link;
    }

    public function testSendInvoice(): Message
    {
        $msg = self::$client->sendInvoice(
            chat_id: self::$chatId,
            title: 'Integration Test Invoice',
            description: 'Pechkin integration test',
            payload: 'integration_test_payload',
            currency: 'USD',
            prices: [['label' => 'Item', 'amount' => 100]],
            provider_token: self::$paymentProviderToken,
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->invoice);

        return $msg;
    }

    // -------------------------------------------------------------------------
    // Stars read-only (also in ClientTest, duplicated here for completeness)
    // -------------------------------------------------------------------------

    public function testGetStarTransactions(): void
    {
        $txns = self::$client->getStarTransactions(limit: 10);
        $this->assertInstanceOf(StarTransactions::class, $txns);
        $this->assertIsArray($txns->transactions);
    }

    // -------------------------------------------------------------------------
    // Refund / subscription edit — require real charge IDs; assert 4xx with
    // a real provider token to verify the serialization path.
    // -------------------------------------------------------------------------

    public function testRefundStarPaymentWithFakeChargeId(): void
    {
        // A real charge ID would come from a completed Stars payment webhook.
        // The provider token is valid — we just don't have a real charge ID here.
        $this->assertApiError(fn() =>
            self::$client->refundStarPayment(
                user_id: 1,
                telegram_payment_charge_id: 'fake_charge_id',
            )
        );
    }

    public function testEditUserStarSubscriptionWithFakeChargeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->editUserStarSubscription(
                user_id: 1,
                telegram_payment_charge_id: 'fake_charge_id',
                is_canceled: true,
            )
        );
    }

    // -------------------------------------------------------------------------
    // Gifts — require a real user to send to; assert 4xx here.
    // If TELEGRAM_TEST_USER_ID is also set, a real sendGift test would be
    // meaningful but carries a Stars cost — left as a manual test.
    // -------------------------------------------------------------------------

    public function testGetChatGifts(): void
    {
        $result =  self::$client->getChatGifts(chat_id: self::$chatId);
        $this->assertInstanceOf(OwnedGifts::class, $result);
    }

    public function testSendGiftWithFakeGiftId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->sendGift(gift_id: 'fake_gift_id', user_id: 1)
        );
    }

    public function testGiftPremiumSubscriptionWithFakeUser(): void
    {
        // Stars cost is real — only fires with a fake user_id to trigger 4xx
        $this->assertApiError(fn() =>
            self::$client->giftPremiumSubscription(
                user_id: 1,
                month_count: 3,
                star_count: 1000,
            )
        );
    }

    // -------------------------------------------------------------------------
    // Subscription invite links (requires a channel with subscriptions enabled)
    // -------------------------------------------------------------------------

    public function testCreateChatSubscriptionInviteLink(): void
    {
        // Regular groups don't support subscription invite links — expect 4xx
        $this->assertApiError(fn() =>
            self::$client->createChatSubscriptionInviteLink(
                chat_id: self::$chatId,
                subscription_period: 2592000, // 30 days
                subscription_price: 100,
            )
        );
    }
}
