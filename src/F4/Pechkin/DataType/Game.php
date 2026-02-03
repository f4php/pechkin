<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Animation,
    MessageEntity,
    PhotoSize,
    Attribute\ArrayOf,
};

readonly class Game extends AbstractDataType
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        /** @var PhotoSize[] */
        #[ArrayOf(PhotoSize::class)]
        public readonly array $photo,
        public readonly ?string $text = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $text_entities = null,
        public readonly ?Animation $animation = null,
    ) {}
}
