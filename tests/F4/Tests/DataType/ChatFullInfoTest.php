<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\{
    AcceptedGiftTypes,
    Birthdate,
    BusinessIntro,
    BusinessLocation,
    BusinessOpeningHours,
    Chat,
    ChatFullInfo,
    ChatLocation,
    ChatPermissions,
    ChatPhoto,
    Message,
    ReactionType,
    UniqueGiftColors,
    UserRating,
};

final class ChatFullInfoTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'id' => '123456789',
            'type' => 'supergroup',
            'title' => 'Test Group',
            'username' => 'testgroup',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'is_forum' => true,
            'is_direct_messages' => false,
            'accent_color_id' => 5,
            'max_reaction_count' => 11,
            'photo' => [
                'small_file_id' => 'AgACAgIAAxkBAAI',
                'small_file_unique_id' => 'AQADAgATqNAxGw',
                'big_file_id' => 'AgACAgIAAxkBAAJ',
                'big_file_unique_id' => 'AQADAgATqNAxGx',
            ],
            'active_usernames' => ['testgroup', 'testgroup2'],
            'birthdate' => [
                'day' => 15,
                'month' => 6,
                'year' => 1990,
            ],
            'business_intro' => [
                'title' => 'Welcome to our business',
                'message' => 'We offer great services',
            ],
            'business_location' => [
                'address' => '123 Main Street, New York, NY 10001',
                'location' => [
                    'latitude' => 40.7128,
                    'longitude' => -74.0060,
                ],
            ],
            'business_opening_hours' => [
                'time_zone_name' => 'America/New_York',
                'opening_hours' => [
                    ['opening_minute' => 540, 'closing_minute' => 1080],
                    ['opening_minute' => 1980, 'closing_minute' => 2520],
                ],
            ],
            'personal_chat' => [
                'id' => 987654321,
                'type' => 'channel',
                'title' => 'Personal Channel',
            ],
            'parent_chat' => [
                'id' => 111222333,
                'type' => 'channel',
                'title' => 'Parent Channel',
            ],
            'available_reactions' => [
                ['type' => 'emoji', 'emoji' => '👍'],
                ['type' => 'emoji', 'emoji' => '❤️'],
                ['type' => 'custom_emoji', 'custom_emoji_id' => '5368324170671202286'],
            ],
            'background_custom_emoji_id' => '5368324170671202286',
            'profile_accent_color_id' => 3,
            'profile_background_custom_emoji_id' => '5368324170671202287',
            'emoji_status_custom_emoji_id' => '5368324170671202288',
            'emoji_status_expiration_date' => 1700000000,
            'bio' => 'This is a test bio',
            'has_private_forwards' => true,
            'has_restricted_voice_and_video_messages' => true,
            'join_to_send_messages' => true,
            'join_by_request' => true,
            'description' => 'This is a test group description',
            'invite_link' => 'https://t.me/joinchat/AAAAAAA',
            'pinned_message' => [
                'message_id' => 12345,
                'date' => 1700000000,
                'chat' => ['id' => 123456789, 'type' => 'supergroup', 'title' => 'Test Group'],
                'text' => 'This is a pinned message',
            ],
            'permissions' => [
                'can_send_messages' => true,
                'can_send_audios' => true,
                'can_send_documents' => true,
                'can_send_photos' => true,
                'can_send_videos' => true,
                'can_send_video_notes' => false,
                'can_send_voice_notes' => false,
                'can_send_polls' => true,
                'can_send_other_messages' => true,
                'can_add_web_page_previews' => true,
                'can_change_info' => false,
                'can_invite_users' => true,
                'can_pin_messages' => false,
                'can_manage_topics' => false,
            ],
            'accepted_gift_types' => [
                'unlimited_gifts' => true,
                'limited_gifts' => true,
                'unique_gifts' => false,
                'premium_subscription' => true,
                'gifts_from_channels' => true,
            ],
            'can_send_paid_media' => true,
            'slow_mode_delay' => 5,
            'unrestrict_boost_count' => 2,
            'message_auto_delete_time' => 180,
            'has_aggressive_anti_spam_enabled' => true,
            'has_hidden_members' => true,
            'has_protected_content' => true,
            'has_visible_history' => true,
            'sticker_set_name' => 'TestStickerSet',
            'can_set_sticker_set' => true,
            'custom_emoji_sticker_set_name' => 'TestCustomEmojiSet',
            'linked_chat_id' => '42321',
            'location' => [
                'location' => [
                    'latitude' => 40.7128,
                    'longitude' => -74.0060,
                ],
                'address' => '123 Main Street, New York',
            ],
            'rating' => [
                'level' => 5,
                'rating' => 1500,
                'current_level_rating' => 500,
                'next_level_rating' => 1000,
            ],
            'unique_gift_colors' => [
                'primary_color' => 16777215,
                'peach_color' => 16753920,
                'background_color' => 0,
                'text_color' => 16777215,
                'accent_color' => 16711680,
            ],
            'paid_message_star_count' => 42,
        ];
        $info = ChatFullInfo::fromArray($data);

        $this->assertSame('123456789', $info->id);
        $this->assertSame('supergroup', $info->type);
        $this->assertSame('Test Group', $info->title);
        $this->assertSame('testgroup', $info->username);
        $this->assertSame('John', $info->first_name);
        $this->assertSame('Doe', $info->last_name);
        $this->assertTrue($info->is_forum);
        $this->assertTrue($info->is_direct_messages);
        $this->assertSame(5, $info->accent_color_id);
        $this->assertSame(11, $info->max_reaction_count);
        $this->assertInstanceOf(ChatPhoto::class, $info->photo);
        $this->assertSame('AgACAgIAAxkBAAI', $info->photo->small_file_id);
        $this->assertSame(['testgroup', 'testgroup2'], $info->active_usernames);
        $this->assertInstanceOf(Birthdate::class, $info->birthdate);
        $this->assertSame(15, $info->birthdate->day);
        $this->assertInstanceOf(BusinessIntro::class, $info->business_intro);
        $this->assertSame('Welcome to our business', $info->business_intro->title);
        $this->assertInstanceOf(BusinessLocation::class, $info->business_location);
        $this->assertSame('123 Main Street, New York, NY 10001', $info->business_location->address);
        $this->assertInstanceOf(BusinessOpeningHours::class, $info->business_opening_hours);
        $this->assertCount(2, $info->business_opening_hours->opening_hours);
        $this->assertSame('America/New_York', $info->business_opening_hours->time_zone_name);
        $this->assertInstanceOf(Chat::class, $info->personal_chat);
        $this->assertInstanceOf(Chat::class, $info->parent_chat);
        $this->assertIsArray($info->available_reactions);
        $this->assertCount(3, $info->available_reactions);
        $this->assertInstanceOf(ReactionType::class, $info->available_reactions[0]);
        $this->assertInstanceOf(ReactionType::class, $info->available_reactions[1]);
        $this->assertInstanceOf(ReactionType::class, $info->available_reactions[2]);
        $this->assertSame('background_custom_emoji_id', $info->background_custom_emoji_id);
        $this->assertSame(3, $info->profile_accent_color_id);
        $this->assertSame('5368324170671202287', $info->profile_background_custom_emoji_id);
        $this->assertSame('5368324170671202287', $info->emoji_status_custom_emoji_id);
        $this->assertSame(1700000000, $info->emoji_status_expiration_date);
        $this->assertSame('This is a test bio', $info->bio);
        $this->assertTrue($info->has_private_forwards);
        $this->assertTrue($info->has_restricted_voice_and_video_messages);
        $this->assertTrue($info->join_to_send_messages);
        $this->assertTrue($info->join_by_request);
        $this->assertSame('This is a test group description', $info->description);
        $this->assertSame('https://t.me/joinchat/AAAAAAA', $info->invite_link);
        $this->assertInstanceOf(Message::class, $info->pinned_message);
        $this->assertInstanceOf(ChatPermissions::class, $info->permissions);
        $this->assertInstanceOf(AcceptedGiftTypes::class, $info->accepted_gift_types);
        $this->assertTrue($info->accepted_gift_types->unlimited_gifts);
        $this->assertTrue($info->can_send_paid_media);
        $this->assertSame(5, $info->slow_mode_delay);
        $this->assertSame(2, $info->unrestrict_boost_count);
        $this->assertSame(180, $info->message_auto_delete_time);
        $this->assertTrue($info->has_aggressive_anti_spam_enabled);
        $this->assertTrue($info->has_hidden_members);
        $this->assertTrue($info->has_protected_content);
        $this->assertTrue($info->has_visible_history);
        $this->assertSame('TestStickerSet', $info->sticker_set_name);
        $this->assertTrue($info->can_set_sticker_set);
        $this->assertSame('TestCustomEmojiSet', $info->custom_emoji_sticker_set_name);
        $this->assertSame('42321', $info->linked_chat_id);
        $this->assertInstanceOf(ChatLocation::class, $info->location);
        $this->assertSame('123 Main Street, New York', $info->location->address);
        $this->assertInstanceOf(UserRating::class, $info->rating);
        $this->assertSame(5, $info->rating->level);
        $this->assertInstanceOf(UniqueGiftColors::class, $info->unique_gift_colors);
        $this->assertSame(42, $info->paid_message_star_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'id' => '111222333',
            'type' => 'private',
            'accent_color_id' => 1,
            'max_reaction_count' => 11,
            'accepted_gift_types' => ['unlimited_gifts' => true, 'limited_gifts' => false, 'unique_gifts' => false, 'premium_subscription' => false, 'gifts_from_channels' => true],
        ];
        $info = ChatFullInfo::fromArray($data);

        $this->assertSame('111222333', $info->id);
        $this->assertSame('private', $info->type);
        $this->assertSame(1, $info->accent_color_id);
        $this->assertSame(11, $info->max_reaction_count);
        $this->assertInstanceOf(AcceptedGiftTypes::class, $info->accepted_gift_types);

        $this->assertNull($info->id);
        $this->assertNull($info->type);
        $this->assertNull($info->title);
        $this->assertNull($info->username);
        $this->assertNull($info->first_name);
        $this->assertNull($info->last_name);
        $this->assertTrue($info->is_forum);
        $this->assertTrue($info->is_direct_messages);
        $this->assertNull($info->accent_color_id);
        $this->assertNull($info->max_reaction_count);
        $this->assertNull($info->photo);
        $this->assertNull($info->active_usernames);
        $this->assertNull($info->birthdate);
        $this->assertNull($info->business_intro);
        $this->assertNull($info->business_location);
        $this->assertNull($info->business_opening_hours);
        $this->assertNull($info->personal_chat);
        $this->assertNull($info->parent_chat);
        $this->assertNull($info->available_reactions);
        $this->assertNull($info->background_custom_emoji_id);
        $this->assertNull($info->profile_accent_color_id);
        $this->assertNull($info->profile_background_custom_emoji_id);
        $this->assertNull($info->emoji_status_custom_emoji_id);
        $this->assertNull($info->emoji_status_expiration_date);
        $this->assertNull($info->bio);
        $this->assertTrue($info->has_private_forwards);
        $this->assertTrue($info->has_restricted_voice_and_video_messages);
        $this->assertTrue($info->join_to_send_messages);
        $this->assertTrue($info->join_by_request);
        $this->assertNull($info->description);
        $this->assertNull($info->invite_link);
        $this->assertNull($info->pinned_message);
        $this->assertNull($info->permissions);
        $this->assertNull($info->accepted_gift_types);
        $this->assertTrue($info->can_send_paid_media);
        $this->assertNull($info->slow_mode_delay);
        $this->assertNull($info->unrestrict_boost_count);
        $this->assertNull($info->message_auto_delete_time);
        $this->assertTrue($info->has_aggressive_anti_spam_enabled);
        $this->assertTrue($info->has_hidden_members);
        $this->assertTrue($info->has_protected_content);
        $this->assertTrue($info->has_visible_history);
        $this->assertNull($info->sticker_set_name);
        $this->assertTrue($info->can_set_sticker_set);
        $this->assertNull($info->custom_emoji_sticker_set_name);
        $this->assertNull($info->linked_chat_id);
        $this->assertNull($info->location);
        $this->assertNull($info->rating);
        $this->assertNull($info->unique_gift_colors);
        $this->assertNull($info->paid_message_star_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'id' => '123456789',
            'type' => 'supergroup',
            'title' => 'Test Group',
            'username' => 'testgroup',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'is_forum' => true,
            'is_direct_messages' => false,
            'accent_color_id' => 5,
            'max_reaction_count' => 11,
            'photo' => [
                'small_file_id' => 'AgACAgIAAxkBAAI',
                'small_file_unique_id' => 'AQADAgATqNAxGw',
                'big_file_id' => 'AgACAgIAAxkBAAJ',
                'big_file_unique_id' => 'AQADAgATqNAxGx',
            ],
            'active_usernames' => ['testgroup', 'testgroup2'],
            'birthdate' => [
                'day' => 15,
                'month' => 6,
                'year' => 1990,
            ],
            'business_intro' => [
                'title' => 'Welcome to our business',
                'message' => 'We offer great services',
            ],
            'business_location' => [
                'address' => '123 Main Street, New York, NY 10001',
                'location' => [
                    'latitude' => 40.7128,
                    'longitude' => -74.0060,
                ],
            ],
            'business_opening_hours' => [
                'time_zone_name' => 'America/New_York',
                'opening_hours' => [
                    ['opening_minute' => 540, 'closing_minute' => 1080],
                    ['opening_minute' => 1980, 'closing_minute' => 2520],
                ],
            ],
            'personal_chat' => [
                'id' => 987654321,
                'type' => 'channel',
                'title' => 'Personal Channel',
            ],
            'parent_chat' => [
                'id' => 111222333,
                'type' => 'channel',
                'title' => 'Parent Channel',
            ],
            'available_reactions' => [
                ['type' => 'emoji', 'emoji' => '👍'],
                ['type' => 'emoji', 'emoji' => '❤️'],
                ['type' => 'custom_emoji', 'custom_emoji_id' => '5368324170671202286'],
            ],
            'background_custom_emoji_id' => '5368324170671202286',
            'profile_accent_color_id' => 3,
            'profile_background_custom_emoji_id' => '5368324170671202287',
            'emoji_status_custom_emoji_id' => '5368324170671202288',
            'emoji_status_expiration_date' => 1700000000,
            'bio' => 'This is a test bio',
            'has_private_forwards' => true,
            'has_restricted_voice_and_video_messages' => true,
            'join_to_send_messages' => true,
            'join_by_request' => true,
            'description' => 'This is a test group description',
            'invite_link' => 'https://t.me/joinchat/AAAAAAA',
            'pinned_message' => [
                'message_id' => 12345,
                'date' => 1700000000,
                'chat' => ['id' => 123456789, 'type' => 'supergroup', 'title' => 'Test Group'],
                'text' => 'This is a pinned message',
            ],
            'permissions' => [
                'can_send_messages' => true,
                'can_send_audios' => true,
                'can_send_documents' => true,
                'can_send_photos' => true,
                'can_send_videos' => true,
                'can_send_video_notes' => false,
                'can_send_voice_notes' => false,
                'can_send_polls' => true,
                'can_send_other_messages' => true,
                'can_add_web_page_previews' => true,
                'can_change_info' => false,
                'can_invite_users' => true,
                'can_pin_messages' => false,
                'can_manage_topics' => false,
            ],
            'accepted_gift_types' => [
                'unlimited_gifts' => true,
                'limited_gifts' => true,
                'unique_gifts' => false,
                'premium_subscription' => true,
                'gifts_from_channels' => true,
            ],
            'can_send_paid_media' => true,
            'slow_mode_delay' => 5,
            'unrestrict_boost_count' => 2,
            'message_auto_delete_time' => 180,
            'has_aggressive_anti_spam_enabled' => true,
            'has_hidden_members' => true,
            'has_protected_content' => true,
            'has_visible_history' => true,
            'sticker_set_name' => 'TestStickerSet',
            'can_set_sticker_set' => true,
            'custom_emoji_sticker_set_name' => 'TestCustomEmojiSet',
            'linked_chat_id' => '42321',
            'location' => [
                'location' => [
                    'latitude' => 40.7128,
                    'longitude' => -74.0060,
                ],
                'address' => '123 Main Street, New York',
            ],
            'rating' => [
                'level' => 5,
                'rating' => 1500,
                'current_level_rating' => 500,
                'next_level_rating' => 1000,
            ],
            'unique_gift_colors' => [
                'primary_color' => 16777215,
                'peach_color' => 16753920,
                'background_color' => 0,
                'text_color' => 16777215,
                'accent_color' => 16711680,
            ],
            'paid_message_star_count' => 42,
        ];
        $info = ChatFullInfo::fromArray($data);
        $this->assertSame($data, $info->toArray());
    }
}
