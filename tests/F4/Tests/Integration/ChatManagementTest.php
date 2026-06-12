<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\DataType\{
    ChatPermissions,
    InputFile,
    Message,
    ReactionTypeEmoji,
};
use PHPUnit\Framework\Attributes\{
    Depends,
    Group,
};

/**
 * Chat settings, live locations and reactions. Permission-dependent operations
 * use attemptOrSkip() so a bot without admin rights skips instead of failing.
 */
#[Group('integration')]
#[Group('integration:basic')]
final class ChatManagementTest extends IntegrationTestCase
{
    // -------------------------------------------------------------------------
    // Chat settings
    // -------------------------------------------------------------------------

    public function testSetChatTitle(): void
    {
        $chat = self::$client->getChat(chat_id: self::$chatId);
        $originalTitle = $chat->title ?? 'Integration Test Chat';

        $result = $this->attemptOrSkip(fn() => self::$client->setChatTitle(
            chat_id: self::$chatId,
            title: $originalTitle . ' *',
        ), 'setChatTitle');
        $this->assertTrue($result);

        // restore
        self::$client->setChatTitle(chat_id: self::$chatId, title: $originalTitle);
    }

    public function testSetChatDescription(): void
    {
        $chat = self::$client->getChat(chat_id: self::$chatId);
        $original = $chat->description;

        $result = $this->attemptOrSkip(fn() => self::$client->setChatDescription(
            chat_id: self::$chatId,
            description: '[integration] updated ' . time(),
        ), 'setChatDescription');
        $this->assertTrue($result);

        // restore (null/empty clears the description)
        self::$client->setChatDescription(chat_id: self::$chatId, description: $original ?? '');
    }

    public function testSetChatPhoto(): void
    {
        $result = $this->attemptOrSkip(fn() => self::$client->setChatPhoto(
            chat_id: self::$chatId,
            photo: new InputFile('chat_photo.png', self::fixture('photo_512.png')),
        ), 'setChatPhoto');
        $this->assertTrue($result);
    }

    #[Depends('testSetChatPhoto')]
    public function testDeleteChatPhoto(): void
    {
        $result = $this->attemptOrSkip(
            fn() => self::$client->deleteChatPhoto(chat_id: self::$chatId),
            'deleteChatPhoto',
        );
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Live location chain
    // -------------------------------------------------------------------------

    public function testSendLiveLocation(): Message
    {
        $msg = self::$client->sendLocation(
            chat_id: self::$chatId,
            latitude: 52.5200,
            longitude: 13.4050,
            live_period: 60,
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->location);
        $this->assertNotNull($msg->location->live_period);

        return $msg;
    }

    #[Depends('testSendLiveLocation')]
    public function testEditMessageLiveLocation(Message $msg): Message
    {
        $result = self::$client->editMessageLiveLocation(
            latitude: 48.8566,
            longitude: 2.3522,
            chat_id: self::$chatId,
            message_id: $msg->message_id,
        );

        $this->assertInstanceOf(Message::class, $result);

        return $msg;
    }

    #[Depends('testEditMessageLiveLocation')]
    public function testStopMessageLiveLocation(Message $msg): void
    {
        $result = self::$client->stopMessageLiveLocation(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
        );

        $this->assertInstanceOf(Message::class, $result);
    }

    // -------------------------------------------------------------------------
    // Reaction chain
    // -------------------------------------------------------------------------

    public function testSetMessageReaction(): Message
    {
        $msg = self::$client->sendMessage(
            chat_id: self::$chatId,
            text: '[integration] reaction target',
        );

        $result = $this->attemptOrSkip(fn() => self::$client->setMessageReaction(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
            reaction: [new ReactionTypeEmoji(emoji: '👍')],
        ), 'setMessageReaction');
        $this->assertTrue($result);

        return $msg;
    }

    #[Depends('testSetMessageReaction')]
    public function testDeleteMessageReaction(Message $msg): Message
    {
        $result = $this->attemptOrSkip(fn() => self::$client->deleteMessageReaction(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
            user_id: self::$botId,
        ), 'deleteMessageReaction');
        $this->assertTrue($result);

        return $msg;
    }

    #[Depends('testDeleteMessageReaction')]
    public function testDeleteAllMessageReactions(Message $msg): void
    {
        $result = $this->attemptOrSkip(fn() => self::$client->deleteAllMessageReactions(
            chat_id: self::$chatId,
            user_id: self::$botId,
        ), 'deleteAllMessageReactions');
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Supergroup/channel-only operations — serialization smoke tests
    // -------------------------------------------------------------------------

    public function testSetChatPermissions(): void
    {
        // permissive values only, so the test group is never locked down
        $result = $this->attemptOrSkip(fn() => self::$client->setChatPermissions(
            chat_id: self::$chatId,
            permissions: new ChatPermissions(
                can_send_messages: true,
                can_send_other_messages: true,
                can_add_web_page_previews: true,
                can_invite_users: true,
            ),
        ), 'setChatPermissions');
        $this->assertTrue($result);
    }

    public function testSetChatStickerSet(): void
    {
        // only valid for supergroups with enough members
        $this->assertApiError(fn() =>
            self::$client->setChatStickerSet(
                chat_id: self::$chatId,
                sticker_set_name: 'AnimatedEmojies',
            )
        );
    }

    public function testDeleteChatStickerSet(): void
    {
        $this->assertApiError(fn() =>
            self::$client->deleteChatStickerSet(chat_id: self::$chatId)
        );
    }

    public function testEditChatSubscriptionInviteLink(): void
    {
        // subscription links exist only in channels; see ChannelClientTest for the real path
        $this->assertApiError(fn() =>
            self::$client->editChatSubscriptionInviteLink(
                chat_id: self::$chatId,
                invite_link: 'https://t.me/+fake_invite_link',
                name: 'integration',
            )
        );
    }
}
