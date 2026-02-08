<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    OwnedGift,
    UniqueGift,
    User,
};

readonly class OwnedGiftUnique extends OwnedGift
{
    public readonly string $type;
    public function __construct(
        public readonly UniqueGift $gift,
        public readonly int $send_date,
        public readonly ?string $owned_gift_id = null,
        public readonly ?User $sender_user = null,
        public readonly ?bool $is_saved = null,
        public readonly ?bool $can_be_transferred = null,
        public readonly ?int $transfer_star_count = null,
        public readonly ?int $next_transfer_date = null,
    ) {
        $this->type = 'unique';
    }
}
