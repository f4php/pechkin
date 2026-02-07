<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Gift,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class GiftInfo extends AbstractDataType
{
    public function __construct(
        public readonly Gift $gift,
        public readonly ?int $prepaid_upgrade_star_count = null,
        public readonly ?string $owned_gift_id = null,
        public readonly ?int $convert_star_count = null,
        public readonly ?bool $is_upgrade_separate = null,
        public readonly ?bool $can_be_upgraded = null,
        public readonly ?string $text = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $entities = null,
        public readonly ?bool $is_private = null,
        public readonly ?int $unique_gift_number = null,

    ) {}
}
