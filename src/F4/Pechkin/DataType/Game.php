<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    Animation,
    MessageEntity,
    PhotoSize,
    Attribute\ArrayOf,
};

use function mb_strlen;

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
    ) {
        if ($this->text !== null && mb_strlen($this->text) > 4096) {
            throw new InvalidArgumentException('Text length cannot exceed 4096 characters');
        }
    }
}
