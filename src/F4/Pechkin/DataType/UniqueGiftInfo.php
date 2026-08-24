<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
    UniqueGift,
    Attribute\ArrayOf,
};

use function in_array;

readonly class UniqueGiftInfo extends AbstractDataType
{
    public function __construct(
        public readonly UniqueGift $gift,
        public readonly string $origin,
        public readonly ?string $text = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $entities = null,
        public readonly ?bool $is_private = null,
        public readonly ?string $last_resale_currency = null,
        public readonly ?int $last_resale_amount = null,
        public readonly ?string $owned_gift_id = null,
        public readonly ?int $transfer_star_count = null,
        public readonly ?int $next_transfer_date = null,
    ) {
        
        if(!in_array(needle: $this->origin, haystack: ['upgrade', 'transfer', 'resale', 'gifted_upgrade', 'offer'], strict: true)) {
            throw new InvalidArgumentException('Unsupported '.__CLASS__.' origin');
        }
    }
}
