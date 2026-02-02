<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Message,
};

readonly class GiveawayCompleted extends AbstractDataType
{
    public function __construct(
        public readonly int $winner_count,
        public readonly ?int $unclaimed_prize_count = null,
        public readonly ?Message $giveaway_message = null,
        public readonly ?bool $is_star_giveaway  = null,
    ) {}
}
