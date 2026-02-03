<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    AcceptedGiftTypes,
    Birthdate,
    BusinessIntro,
    BusinessLocation,
    BusinessOpeningHours,
    Chat,
    ChatLocation,
    ChatPermissions,
    ChatPhoto,
    Message,
    ReactionType,
    ReactionTypeCustomEmoji,
    ReactionTypeEmoji,
    ReactionTypePaid,
    UniqueGiftColors,
    UserRating,
    Attribute\ArrayOf,
    Attribute\Polymorphic,
};

readonly class ChatFullInfo extends AbstractDataType
{
    public function __construct(
        public readonly string $id, // may not fit in a 32-bit integer
        public readonly string $type,
        public readonly int $accent_color_id,
        public readonly int $max_reaction_count,
        public readonly AcceptedGiftTypes $accepted_gift_types,
        public readonly ?string $title = null,
        public readonly ?string $username = null,
        public readonly ?string $first_name = null,
        public readonly ?string $last_name = null,
        public readonly ?bool $is_forum = null,
        public readonly ?bool $is_direct_messages = null,
        public readonly ?ChatPhoto $photo = null,
        /** @var string[]|null */
        #[ArrayOf('string')]
        public readonly ?array $active_usernames = null,
        public readonly ?Birthdate $birthdate = null,
        public readonly ?BusinessIntro $business_intro = null,
        public readonly ?BusinessLocation $business_location = null,
        public readonly ?BusinessOpeningHours $business_opening_hours = null,
        public readonly ?Chat $personal_chat = null,
        public readonly ?Chat $parent_chat = null,
        /** @var ReactionType[]|null */
        #[ArrayOf(new Polymorphic([
            'custom_emoji' => ReactionTypeCustomEmoji::class,
            'emoji' => ReactionTypeEmoji::class,
            'paid' => ReactionTypePaid::class,
        ]))]
        public readonly ?array $available_reactions = null,
        public readonly ?string $background_custom_emoji_id = null,
        public readonly ?int $profile_accent_color_id = null,
        public readonly ?string $profile_background_custom_emoji_id = null,
        public readonly ?string $emoji_status_custom_emoji_id = null,
        public readonly ?int $emoji_status_expiration_date = null,
        public readonly ?string $bio = null,
        public readonly ?bool $has_private_forwards = null,
        public readonly ?bool $has_restricted_voice_and_video_messages = null,
        public readonly ?bool $join_to_send_messages = null,
        public readonly ?bool $join_by_request = null,
        public readonly ?string $description = null,
        public readonly ?string $invite_link = null,
        public readonly ?Message $pinned_message = null,
        public readonly ?ChatPermissions $permissions = null,
        public readonly ?bool $can_send_paid_media = null,
        public readonly ?int $slow_mode_delay = null,
        public readonly ?int $unrestrict_boost_count = null,
        public readonly ?int $message_auto_delete_time = null,
        public readonly ?bool $has_aggressive_anti_spam_enabled = null,
        public readonly ?bool $has_hidden_members = null,
        public readonly ?bool $has_protected_content = null,
        public readonly ?bool $has_visible_history = null,
        public readonly ?string $sticker_set_name = null,
        public readonly ?bool $can_set_sticker_set = null,
        public readonly ?string $custom_emoji_sticker_set_name = null,
        public readonly ?string $linked_chat_id = null, // may not fit in 32-bit int
        public readonly ?ChatLocation $location = null,
        public readonly ?UserRating $rating = null,
        public readonly ?UniqueGiftColors $unique_gift_colors = null,
        public readonly ?int $paid_message_star_count = null,
    ) {
    }
}
