<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MaybeInaccessibleMessage,
    MessageEntity,
    Attribute\ArrayOf,
};

readonly class PollOptionAdded extends AbstractDataType
{
    public function __construct(
        public readonly string $option_persistent_id,
        public readonly string $option_text,
        public readonly ?MaybeInaccessibleMessage $poll_message = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $option_text_entities = null,
    ) {}
}
