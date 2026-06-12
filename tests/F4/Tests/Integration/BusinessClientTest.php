<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\DataType\{
    AcceptedGiftTypes,
    BusinessConnection,
    InputChecklist,
    InputChecklistTask,
    InputProfilePhotoStatic,
    InputStoryContentPhoto,
    Message,
    OwnedGifts,
    StarAmount,
};
use PHPUnit\Framework\Attributes\{
    Depends,
    Group,
};

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
#[Group('integration')]
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

    // -------------------------------------------------------------------------
    // Profile photo and username
    // -------------------------------------------------------------------------

    public function testSetBusinessAccountProfilePhoto(): void
    {
        // InputProfilePhotoStatic.photo is an attach:// reference, but the request
        // is sent as JSON — uploading a new photo cannot succeed through this
        // client yet; a 4xx proves the request shape is correct
        $this->assertApiError(fn() =>
            self::$client->setBusinessAccountProfilePhoto(
                business_connection_id: self::$businessConnectionId,
                photo: new InputProfilePhotoStatic(photo: 'attach://unsupported'),
            )
        );
    }

    public function testRemoveBusinessAccountProfilePhoto(): void
    {
        $result = $this->attemptOrSkip(fn() => self::$client->removeBusinessAccountProfilePhoto(
            business_connection_id: self::$businessConnectionId,
        ), 'removeBusinessAccountProfilePhoto');
        $this->assertTrue($result);
    }

    public function testSetBusinessAccountUsername(): void
    {
        // re-set the current username to avoid changing visible state
        $conn = self::$client->getBusinessConnection(self::$businessConnectionId);

        $result = $this->attemptOrSkip(fn() => self::$client->setBusinessAccountUsername(
            business_connection_id: self::$businessConnectionId,
            username: $conn->user->username,
        ), 'setBusinessAccountUsername');
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Checklists
    // -------------------------------------------------------------------------

    public function testSendChecklist(): Message
    {
        $msg = $this->attemptOrSkip(fn() => self::$client->sendChecklist(
            chat_id: self::$chatId,
            checklist: new InputChecklist(
                title: '[integration] checklist',
                tasks: [
                    new InputChecklistTask(id: 1, text: 'first task'),
                    new InputChecklistTask(id: 2, text: 'second task'),
                ],
            ),
            business_connection_id: self::$businessConnectionId,
        ), 'sendChecklist');

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->checklist);

        return $msg;
    }

    #[Depends('testSendChecklist')]
    public function testEditMessageChecklist(Message $msg): void
    {
        $result = self::$client->editMessageChecklist(
            business_connection_id: self::$businessConnectionId,
            chat_id: self::$chatId,
            message_id: $msg->message_id,
            checklist: new InputChecklist(
                title: '[integration] checklist (edited)',
                tasks: [
                    new InputChecklistTask(id: 1, text: 'first task'),
                    new InputChecklistTask(id: 2, text: 'second task'),
                    new InputChecklistTask(id: 3, text: 'third task'),
                ],
            ),
        );

        $this->assertInstanceOf(Message::class, $result);
    }

    // -------------------------------------------------------------------------
    // Stories — InputStoryContentPhoto.photo is an attach:// reference sent as
    // JSON, so real uploads cannot succeed through this client yet; 4xx smoke
    // tests prove the wiring
    // -------------------------------------------------------------------------

    public function testPostStory(): void
    {
        $this->assertApiError(fn() =>
            self::$client->postStory(
                business_connection_id: self::$businessConnectionId,
                content: new InputStoryContentPhoto(photo: 'attach://unsupported'),
                active_period: 86400,
            )
        );
    }

    public function testEditStory(): void
    {
        $this->assertApiError(fn() =>
            self::$client->editStory(
                business_connection_id: self::$businessConnectionId,
                story_id: 999999999,
                content: new InputStoryContentPhoto(photo: 'attach://unsupported'),
            )
        );
    }

    public function testRepostStory(): void
    {
        $this->assertApiError(fn() =>
            self::$client->repostStory(
                business_connection_id: self::$businessConnectionId,
                from_chat_id: 1,
                from_story_id: 999999999,
                active_period: 86400,
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
