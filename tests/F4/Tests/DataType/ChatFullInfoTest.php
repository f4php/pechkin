<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\AcceptedGiftTypes;
use F4\Pechkin\DataType\Birthdate;
use F4\Pechkin\DataType\BusinessIntro;
use F4\Pechkin\DataType\BusinessLocation;
use F4\Pechkin\DataType\BusinessOpeningHours;
use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatFullInfo;
use F4\Pechkin\DataType\ChatLocation;
use F4\Pechkin\DataType\ChatPermissions;
use F4\Pechkin\DataType\ChatPhoto;
use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\UniqueGiftColors;
use F4\Pechkin\DataType\UserRating;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatFullInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_full_info_full.json');
        $chatFullInfo = ChatFullInfo::fromArray($data);

        $this->assertInstanceOf(ChatFullInfo::class, $chatFullInfo);
        $this->assertInstanceOf(AcceptedGiftTypes::class, $chatFullInfo->accepted_gift_types);
        $this->assertInstanceOf(ChatPhoto::class, $chatFullInfo->photo);
        $this->assertNotEmpty($chatFullInfo->active_usernames);
        $this->assertInstanceOf(Birthdate::class, $chatFullInfo->birthdate);
        $this->assertInstanceOf(BusinessIntro::class, $chatFullInfo->business_intro);
        $this->assertInstanceOf(BusinessLocation::class, $chatFullInfo->business_location);
        $this->assertInstanceOf(BusinessOpeningHours::class, $chatFullInfo->business_opening_hours);
        $this->assertInstanceOf(Chat::class, $chatFullInfo->personal_chat);
        $this->assertInstanceOf(Chat::class, $chatFullInfo->parent_chat);
        $this->assertInstanceOf(Message::class, $chatFullInfo->pinned_message);
        $this->assertInstanceOf(ChatPermissions::class, $chatFullInfo->permissions);
        $this->assertInstanceOf(ChatLocation::class, $chatFullInfo->location);
        $this->assertInstanceOf(UserRating::class, $chatFullInfo->rating);
        $this->assertInstanceOf(UniqueGiftColors::class, $chatFullInfo->unique_gift_colors);
        $this->assertSame('123456789', $chatFullInfo->id);
        $this->assertSame('private', $chatFullInfo->type);
        $this->assertSame(1, $chatFullInfo->accent_color_id);
        $this->assertSame(11, $chatFullInfo->max_reaction_count);
        $this->assertSame('Test Title', $chatFullInfo->title);
        $this->assertSame('johndoe', $chatFullInfo->username);
        $this->assertSame('John', $chatFullInfo->first_name);
        $this->assertSame('Doe', $chatFullInfo->last_name);
        $this->assertSame(false, $chatFullInfo->is_forum);
        $this->assertSame(false, $chatFullInfo->is_direct_messages);
        $this->assertNotEmpty($chatFullInfo->available_reactions);
        $this->assertSame('bg_emoji_456', $chatFullInfo->background_custom_emoji_id);
        $this->assertSame(2, $chatFullInfo->profile_accent_color_id);
        $this->assertSame('profile_emoji_123', $chatFullInfo->profile_background_custom_emoji_id);
        $this->assertSame('status_emoji_789', $chatFullInfo->emoji_status_custom_emoji_id);
        $this->assertSame(1700172800, $chatFullInfo->emoji_status_expiration_date);
        $this->assertSame('Test bio', $chatFullInfo->bio);
        $this->assertSame(false, $chatFullInfo->has_private_forwards);
        $this->assertSame(false, $chatFullInfo->has_restricted_voice_and_video_messages);
        $this->assertSame(false, $chatFullInfo->join_to_send_messages);
        $this->assertSame(false, $chatFullInfo->join_by_request);
        $this->assertSame('Test description', $chatFullInfo->description);
        $this->assertSame('https://t.me/+abc123', $chatFullInfo->invite_link);
        $this->assertSame(true, $chatFullInfo->can_send_paid_media);
        $this->assertSame(30, $chatFullInfo->slow_mode_delay);
        $this->assertSame(3, $chatFullInfo->unrestrict_boost_count);
        $this->assertSame(86400, $chatFullInfo->message_auto_delete_time);
        $this->assertSame(true, $chatFullInfo->has_aggressive_anti_spam_enabled);
        $this->assertSame(true, $chatFullInfo->has_hidden_members);
        $this->assertSame(true, $chatFullInfo->has_protected_content);
        $this->assertSame(true, $chatFullInfo->has_visible_history);
        $this->assertSame('test_sticker_set', $chatFullInfo->sticker_set_name);
        $this->assertSame(true, $chatFullInfo->can_set_sticker_set);
        $this->assertSame('custom_set', $chatFullInfo->custom_emoji_sticker_set_name);
        $this->assertSame('-1001234567890', $chatFullInfo->linked_chat_id);
        $this->assertSame(10, $chatFullInfo->paid_message_star_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_full_info_minimal.json');
        $chatFullInfo = ChatFullInfo::fromArray($data);

        $this->assertInstanceOf(ChatFullInfo::class, $chatFullInfo);
        $this->assertNull($chatFullInfo->title);
        $this->assertNull($chatFullInfo->username);
        $this->assertNull($chatFullInfo->first_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_full_info_full.json');
        $chatFullInfo = ChatFullInfo::fromArray($data);
        $this->assertEquals($data, $chatFullInfo->toArray());
    }
}
