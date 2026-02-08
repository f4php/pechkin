<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Animation;
use F4\Pechkin\DataType\Audio;
use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatBackground;
use F4\Pechkin\DataType\ChatBoostAdded;
use F4\Pechkin\DataType\ChatShared;
use F4\Pechkin\DataType\Checklist;
use F4\Pechkin\DataType\ChecklistTasksAdded;
use F4\Pechkin\DataType\ChecklistTasksDone;
use F4\Pechkin\DataType\Contact;
use F4\Pechkin\DataType\Dice;
use F4\Pechkin\DataType\DirectMessagePriceChanged;
use F4\Pechkin\DataType\DirectMessagesTopic;
use F4\Pechkin\DataType\Document;
use F4\Pechkin\DataType\ExternalReplyInfo;
use F4\Pechkin\DataType\ForumTopicClosed;
use F4\Pechkin\DataType\ForumTopicCreated;
use F4\Pechkin\DataType\ForumTopicEdited;
use F4\Pechkin\DataType\ForumTopicReopened;
use F4\Pechkin\DataType\Game;
use F4\Pechkin\DataType\GeneralForumTopicHidden;
use F4\Pechkin\DataType\GeneralForumTopicUnhidden;
use F4\Pechkin\DataType\GiftInfo;
use F4\Pechkin\DataType\Giveaway;
use F4\Pechkin\DataType\GiveawayCompleted;
use F4\Pechkin\DataType\GiveawayCreated;
use F4\Pechkin\DataType\GiveawayWinners;
use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\Invoice;
use F4\Pechkin\DataType\LinkPreviewOptions;
use F4\Pechkin\DataType\Location;
use F4\Pechkin\DataType\MaybeInaccessibleMessage;
use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\MessageAutoDeleteTimerChanged;
use F4\Pechkin\DataType\MessageOrigin;
use F4\Pechkin\DataType\PaidMediaInfo;
use F4\Pechkin\DataType\PaidMessagePriceChanged;
use F4\Pechkin\DataType\PassportData;
use F4\Pechkin\DataType\Poll;
use F4\Pechkin\DataType\ProximityAlertTriggered;
use F4\Pechkin\DataType\RefundedPayment;
use F4\Pechkin\DataType\Sticker;
use F4\Pechkin\DataType\Story;
use F4\Pechkin\DataType\SuccessfulPayment;
use F4\Pechkin\DataType\SuggestedPostApprovalFailed;
use F4\Pechkin\DataType\SuggestedPostApproved;
use F4\Pechkin\DataType\SuggestedPostDeclined;
use F4\Pechkin\DataType\SuggestedPostInfo;
use F4\Pechkin\DataType\SuggestedPostPaid;
use F4\Pechkin\DataType\SuggestedPostRefunded;
use F4\Pechkin\DataType\TextQuote;
use F4\Pechkin\DataType\UniqueGiftInfo;
use F4\Pechkin\DataType\User;
use F4\Pechkin\DataType\UsersShared;
use F4\Pechkin\DataType\Venue;
use F4\Pechkin\DataType\Video;
use F4\Pechkin\DataType\VideoChatEnded;
use F4\Pechkin\DataType\VideoChatParticipantsInvited;
use F4\Pechkin\DataType\VideoChatScheduled;
use F4\Pechkin\DataType\VideoChatStarted;
use F4\Pechkin\DataType\VideoNote;
use F4\Pechkin\DataType\Voice;
use F4\Pechkin\DataType\WebAppData;
use F4\Pechkin\DataType\WriteAccessAllowed;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_full.json');
        $message = Message::fromArray($data);

        $this->assertInstanceOf(Message::class, $message);
        $this->assertInstanceOf(Chat::class, $message->chat);
        $this->assertInstanceOf(DirectMessagesTopic::class, $message->direct_messages_topic);
        $this->assertInstanceOf(User::class, $message->from);
        $this->assertInstanceOf(Chat::class, $message->sender_chat);
        $this->assertInstanceOf(User::class, $message->sender_business_bot);
        $this->assertSame(42, $message->message_id);
        $this->assertSame(1700000000, $message->date);
        $this->assertSame(42, $message->message_thread_id);
        $this->assertSame(3, $message->sender_boost_count);
        $this->assertSame('biz_conn_123', $message->business_connection_id);
        $this->assertInstanceOf(MessageOrigin::class, $message->forward_origin);
        $this->assertSame(true, $message->is_topic_message);
        $this->assertSame(true, $message->is_automatic_forward);
        $this->assertInstanceOf(Message::class, $message->reply_to_message);
        $this->assertInstanceOf(ExternalReplyInfo::class, $message->external_reply);
        $this->assertInstanceOf(TextQuote::class, $message->quote);
        $this->assertInstanceOf(Story::class, $message->reply_to_story);
        $this->assertSame(1, $message->reply_to_checklist_task_id);
        $this->assertInstanceOf(User::class, $message->via_bot);
        $this->assertSame(1700000100, $message->edit_date);
        $this->assertSame(true, $message->has_protected_content);
        $this->assertSame(true, $message->is_from_offline);
        $this->assertSame(true, $message->is_paid_post);
        $this->assertSame('media_group_123', $message->media_group_id);
        $this->assertSame('Author', $message->author_signature);
        $this->assertSame(50, $message->paid_star_count);
        $this->assertSame('Hello, World!', $message->text);
        $this->assertNotEmpty($message->entities);
        $this->assertInstanceOf(LinkPreviewOptions::class, $message->link_preview_options);
        $this->assertInstanceOf(SuggestedPostInfo::class, $message->suggested_post_info);
        $this->assertSame('effect_123', $message->effect_id);
        $this->assertInstanceOf(Animation::class, $message->animation);
        $this->assertInstanceOf(Audio::class, $message->audio);
        $this->assertInstanceOf(Document::class, $message->document);
        $this->assertInstanceOf(PaidMediaInfo::class, $message->paid_media);
        $this->assertNotEmpty($message->photo);
        $this->assertInstanceOf(Sticker::class, $message->sticker);
        $this->assertInstanceOf(Story::class, $message->story);
        $this->assertInstanceOf(Video::class, $message->video);
        $this->assertInstanceOf(VideoNote::class, $message->video_note);
        $this->assertInstanceOf(Voice::class, $message->voice);
        $this->assertSame('Test caption', $message->caption);
        $this->assertNotEmpty($message->caption_entities);
        $this->assertSame(false, $message->show_caption_above_media);
        $this->assertSame(true, $message->has_media_spoiler);
        $this->assertInstanceOf(Checklist::class, $message->checklist);
        $this->assertInstanceOf(Contact::class, $message->contact);
        $this->assertInstanceOf(Dice::class, $message->dice);
        $this->assertInstanceOf(Game::class, $message->game);
        $this->assertInstanceOf(Poll::class, $message->poll);
        $this->assertInstanceOf(Venue::class, $message->venue);
        $this->assertInstanceOf(Location::class, $message->location);
        $this->assertNotEmpty($message->new_chat_members);
        $this->assertInstanceOf(User::class, $message->left_chat_member);
        $this->assertSame('test_string', $message->new_chat_title);
        $this->assertNotEmpty($message->new_chat_photo);
        $this->assertSame(true, $message->delete_chat_photo);
        $this->assertSame(true, $message->group_chat_created);
        $this->assertSame(true, $message->supergroup_chat_created);
        $this->assertSame(true, $message->channel_chat_created);
        $this->assertInstanceOf(MessageAutoDeleteTimerChanged::class, $message->message_auto_delete_timer_changed);
        $this->assertSame('-1001234567891', $message->migrate_to_chat_id);
        $this->assertSame('-1001234567892', $message->migrate_from_chat_id);
        $this->assertInstanceOf(MaybeInaccessibleMessage::class, $message->pinned_message);
        $this->assertInstanceOf(Invoice::class, $message->invoice);
        $this->assertInstanceOf(SuccessfulPayment::class, $message->successful_payment);
        $this->assertInstanceOf(RefundedPayment::class, $message->refunded_payment);
        $this->assertInstanceOf(UsersShared::class, $message->users_shared);
        $this->assertInstanceOf(ChatShared::class, $message->chat_shared);
        $this->assertInstanceOf(GiftInfo::class, $message->gift);
        $this->assertInstanceOf(UniqueGiftInfo::class, $message->unique_gift);
        $this->assertInstanceOf(GiftInfo::class, $message->gift_upgrade_sent);
        $this->assertSame('https://example.com', $message->connected_website);
        $this->assertInstanceOf(WriteAccessAllowed::class, $message->write_access_allowed);
        $this->assertInstanceOf(PassportData::class, $message->passport_data);
        $this->assertInstanceOf(ProximityAlertTriggered::class, $message->proximity_alert_triggered);
        $this->assertInstanceOf(ChatBoostAdded::class, $message->boost_added);
        $this->assertInstanceOf(ChatBackground::class, $message->chat_background_set);
        $this->assertInstanceOf(ChecklistTasksDone::class, $message->checklist_tasks_done);
        $this->assertInstanceOf(ChecklistTasksAdded::class, $message->checklist_tasks_added);
        $this->assertInstanceOf(DirectMessagePriceChanged::class, $message->direct_message_price_changed);
        $this->assertInstanceOf(ForumTopicCreated::class, $message->forum_topic_created);
        $this->assertInstanceOf(ForumTopicEdited::class, $message->forum_topic_edited);
        $this->assertInstanceOf(ForumTopicClosed::class, $message->forum_topic_closed);
        $this->assertInstanceOf(ForumTopicReopened::class, $message->forum_topic_reopened);
        $this->assertInstanceOf(GeneralForumTopicHidden::class, $message->general_forum_topic_hidden);
        $this->assertInstanceOf(GeneralForumTopicUnhidden::class, $message->general_forum_topic_unhidden);
        $this->assertInstanceOf(GiveawayCreated::class, $message->giveaway_created);
        $this->assertInstanceOf(Giveaway::class, $message->giveaway);
        $this->assertInstanceOf(GiveawayWinners::class, $message->giveaway_winners);
        $this->assertInstanceOf(GiveawayCompleted::class, $message->giveaway_completed);
        $this->assertInstanceOf(PaidMessagePriceChanged::class, $message->paid_message_price_changed);
        $this->assertInstanceOf(SuggestedPostApproved::class, $message->suggested_post_approved);
        $this->assertInstanceOf(SuggestedPostApprovalFailed::class, $message->suggested_post_approval_failed);
        $this->assertInstanceOf(SuggestedPostDeclined::class, $message->suggested_post_declined);
        $this->assertInstanceOf(SuggestedPostPaid::class, $message->suggested_post_paid);
        $this->assertInstanceOf(SuggestedPostRefunded::class, $message->suggested_post_refunded);
        $this->assertInstanceOf(VideoChatScheduled::class, $message->video_chat_scheduled);
        $this->assertInstanceOf(VideoChatStarted::class, $message->video_chat_started);
        $this->assertInstanceOf(VideoChatEnded::class, $message->video_chat_ended);
        $this->assertInstanceOf(VideoChatParticipantsInvited::class, $message->video_chat_participants_invited);
        $this->assertInstanceOf(WebAppData::class, $message->web_app_data);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $message->reply_markup);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('message_minimal.json');
        $message = Message::fromArray($data);

        $this->assertInstanceOf(Message::class, $message);
        $this->assertNull($message->message_thread_id);
        $this->assertNull($message->direct_messages_topic);
        $this->assertNull($message->from);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_minimal.json');
        $message = Message::fromArray($data);
        $this->assertEquals($data, $message->toArray());
    }
}
