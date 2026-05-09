<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    InputPollOptionMedia,
    MessageEntity,
    Attribute\ArrayOf,
};

use function mb_strlen;

readonly class InputPollOption extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly ?string $text_parse_mode = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $text_entities = null,
        public readonly ?InputPollOptionMedia $media = null,
    ) {
        if (mb_strlen($this->text) > 100) {
            throw new InvalidArgumentException('Text length cannot exceed 100 characters');
        }
    }
}
