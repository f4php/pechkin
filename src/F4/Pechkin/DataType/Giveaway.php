<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
};

readonly class Giveaway extends AbstractDataType
{
    public function __construct(
        /** @var Chat[] */
        public readonly array $chats,
        public readonly int $winners_selection_date,
        public readonly int $winner_count,
        public readonly ?bool $only_new_members = null,
        public readonly ?bool $has_public_winners = null,
        public readonly ?string $prize_description = null,
        /** @var string[]|null */
        public readonly ?array $country_codes = null,
        public readonly ?int $prize_star_count = null,
        public readonly ?int $premium_subscription_month_count = null,
    ) {}
}
