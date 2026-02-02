<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    User,
};

readonly class GiveawayWinners extends AbstractDataType
{
    public function __construct(
        public readonly Chat $chat,
        public readonly int $giveaway_message_id,
        public readonly int $winners_selection_date,
        public readonly int $winner_count,
        /** @var User[] */
        public readonly array $winners,
        public readonly ?int $additional_chat_count = null,
        public readonly ?int $premium_subscription_month_count = null,
        public readonly ?int $unclaimed_prize_count = null,
        public readonly ?bool $only_new_members = null,
        public readonly ?bool $was_refunded = null,
        public readonly ?string $prize_description = null,
    ) {}
}
