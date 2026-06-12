<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\DataType\{
    ChatInviteLink,
    InputFile,
    InputPaidMediaPhoto,
    Message,
};
use PHPUnit\Framework\Attributes\{
    Depends,
    Group,
};

/**
 * Channel-only features. Requires TELEGRAM_TEST_CHANNEL_ID — a channel where the
 * bot is an administrator with post, edit and invite-link rights.
 */
#[Group('integration')]
#[Group('integration:channel')]
final class ChannelClientTest extends IntegrationTestCase
{
    protected function setUp(): void
    {
        $this->skipUnlessChannelId();
    }

    public function testSendMessageToChannel(): void
    {
        $msg = self::$client->sendMessage(
            chat_id: self::$channelId,
            text: '[integration] channel smoke test',
        );

        $this->assertInstanceOf(Message::class, $msg);
    }

    public function testSendPaidMedia(): void
    {
        // obtain a photo file_id in the channel, then post it as paid media
        $photo = self::$client->sendPhoto(
            chat_id: self::$channelId,
            photo: new InputFile('photo.png', self::fixture('photo_512.png')),
            caption: '[integration] paid media source',
        );

        $msg = $this->attemptOrSkip(fn() => self::$client->sendPaidMedia(
            chat_id: self::$channelId,
            star_count: 1,
            media: [new InputPaidMediaPhoto(media: $photo->photo[0]->file_id)],
            caption: '[integration] testSendPaidMedia',
        ), 'sendPaidMedia');

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->paid_media);
    }

    public function testCreateChatSubscriptionInviteLink(): ChatInviteLink
    {
        $link = $this->attemptOrSkip(fn() => self::$client->createChatSubscriptionInviteLink(
            chat_id: self::$channelId,
            subscription_period: 2592000, // the only period Telegram currently allows (30 days)
            subscription_price: 1,
            name: '[integration] subscription',
        ), 'createChatSubscriptionInviteLink');

        $this->assertInstanceOf(ChatInviteLink::class, $link);

        return $link;
    }

    #[Depends('testCreateChatSubscriptionInviteLink')]
    public function testEditChatSubscriptionInviteLink(ChatInviteLink $link): ChatInviteLink
    {
        $edited = self::$client->editChatSubscriptionInviteLink(
            chat_id: self::$channelId,
            invite_link: $link->invite_link,
            name: '[integration] subscription (edited)',
        );

        $this->assertInstanceOf(ChatInviteLink::class, $edited);
        $this->assertSame('[integration] subscription (edited)', $edited->name);

        return $edited;
    }

    #[Depends('testEditChatSubscriptionInviteLink')]
    public function testRevokeSubscriptionInviteLink(ChatInviteLink $link): void
    {
        $revoked = self::$client->revokeChatInviteLink(
            chat_id: self::$channelId,
            invite_link: $link->invite_link,
        );

        $this->assertTrue($revoked->is_revoked);
    }
}
