<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\DataType\{
    AcceptedGiftTypes,
    BusinessConnection,
    OwnedGifts,
    StarAmount,
};
use PHPUnit\Framework\Attributes\Group;

/**
 * Tests for Telegram Business account methods.
 *
 * Requires:
 *   TELEGRAM_BOT_TOKEN               — the bot token
 *   TELEGRAM_TEST_CHAT_ID            — a chat the bot is in
 *   TELEGRAM_BUSINESS_CONNECTION_ID  — a Business connection ID from a Telegram
 *                                      Business account that has authorized this bot
 *
 * Run with:
 *   TELEGRAM_BUSINESS_CONNECTION_ID=xxx composer test:integration:business
 */
#[Group('integration:business')]
final class BusinessClientTest extends IntegrationTestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::skipUnlessBusinessIdStatic();
    }

    private static function skipUnlessBusinessIdStatic(): void
    {
        if (self::$businessConnectionId === null) {
            self::markTestSkipped('Requires TELEGRAM_BUSINESS_CONNECTION_ID env var');
        }
    }

    // -------------------------------------------------------------------------
    // Read-only endpoints
    // -------------------------------------------------------------------------

    public function testGetBusinessConnection(): void
    {
        $conn = self::$client->getBusinessConnection(self::$businessConnectionId);
        $this->assertInstanceOf(BusinessConnection::class, $conn);
        $this->assertSame(self::$businessConnectionId, $conn->id);
    }

    public function testGetBusinessAccountStarBalance(): void
    {
        $balance = self::$client->getBusinessAccountStarBalance(self::$businessConnectionId);
        $this->assertInstanceOf(StarAmount::class, $balance);
        $this->assertIsInt($balance->amount);
    }

    public function testGetBusinessAccountGifts(): void
    {
        $gifts = self::$client->getBusinessAccountGifts(
            business_connection_id: self::$businessConnectionId,
        );
        $this->assertInstanceOf(OwnedGifts::class, $gifts);
        $this->assertIsArray($gifts->gifts);
    }

    // -------------------------------------------------------------------------
    // Write endpoints
    // -------------------------------------------------------------------------

    public function testSetBusinessAccountBio(): void
    {
        $result = self::$client->setBusinessAccountBio(
            business_connection_id: self::$businessConnectionId,
            bio: 'Pechkin integration test',
        );
        $this->assertTrue($result);
    }

    public function testSetBusinessAccountName(): void
    {
        $result = self::$client->setBusinessAccountName(
            business_connection_id: self::$businessConnectionId,
            first_name: 'Pechkin',
            last_name: 'Test',
        );
        $this->assertTrue($result);
    }

    public function testSetBusinessAccountGiftSettings(): void
    {
        $result = self::$client->setBusinessAccountGiftSettings(
            business_connection_id: self::$businessConnectionId,
            show_gift_button: true,
            accepted_gift_types: AcceptedGiftTypes::fromArray([
                'unlimited_gifts' => true,
                'limited_gifts' => true,
                'unique_gifts' => true,
                'premium_subscription' => true,
                'gifts_from_channels' => false,
            ]),
        );
        $this->assertTrue($result);
    }

    // Seems to always return true
    public function testDeleteBusinessMessagesWithFakeId(): void
    {
        $this->assertTrue(self::$client->deleteBusinessMessages(
            business_connection_id: self::$businessConnectionId,
            message_ids: [999999999],
        ));
    }
    // -------------------------------------------------------------------------
    // Methods that need specific pre-existing state — assert 4xx to verify
    // serialization path (a real business_connection_id is used, so 4xx means
    // "reached API correctly but lacks the specific resource").
    // -------------------------------------------------------------------------

    public function testReadBusinessMessageWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->readBusinessMessage(
                business_connection_id: self::$businessConnectionId,
                chat_id: self::$chatId,
                message_id: 999999999,
            )
        );
    }

    public function testConvertGiftToStarsWithFakeGiftId(): void
    {
        // Requires a valid owned_gift_id from getBusinessAccountGifts
        $this->assertApiError(fn() =>
            self::$client->convertGiftToStars(
                business_connection_id: self::$businessConnectionId,
                owned_gift_id: 'fake_owned_gift_id',
            )
        );
    }

    public function testTransferGiftWithFakeGiftId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->transferGift(
                business_connection_id: self::$businessConnectionId,
                owned_gift_id: 'fake_owned_gift_id',
                new_owner_chat_id: 1,
            )
        );
    }

    public function testUpgradeGiftWithFakeGiftId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->upgradeGift(
                business_connection_id: self::$businessConnectionId,
                owned_gift_id: 'fake_owned_gift_id',
            )
        );
    }

    public function testDeleteStoryWithFakeId(): void
    {
        // Requires a story_id that actually exists for this business account
        $this->assertApiError(fn() =>
            self::$client->deleteStory(
                business_connection_id: self::$businessConnectionId,
                story_id: 999999999,
            )
        );
    }

    public function testTransferBusinessAccountStarsInsufficientBalance(): void
    {
        // Transferring more stars than the balance holds — expects a 4xx
        $this->assertApiError(fn() =>
            self::$client->transferBusinessAccountStars(
                business_connection_id: self::$businessConnectionId,
                star_count: 999999999,
            )
        );
    }
}
