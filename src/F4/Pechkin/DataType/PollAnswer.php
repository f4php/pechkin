<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    User,
};

readonly class PollAnswer extends AbstractDataType
{
    public function __construct(
        public readonly string $poll_id,
        /** @var int[] */
        public readonly array $option_ids,
        public readonly ?Chat $voter_chat = null,
        public readonly ?User $user = null,
    ) {}
}
