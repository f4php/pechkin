<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
    PollOption,
    Attribute\ArrayOf,
};

readonly class Poll extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly string $question,
        /** @var PollOption[]|null */
        #[ArrayOf(PollOption::class)]
        public readonly array $options,
        public readonly int $total_voter_count,
        public readonly bool $is_closed,
        public readonly bool $is_anonymous,
        public readonly string $type,
        public readonly bool $allows_multiple_answers,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $question_entities = null,
        public readonly ?int $correct_option_id = null,
        public readonly ?string $explanation = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $explanation_entities = null,
        public readonly ?int $open_period = null,
        public readonly ?int $close_date = null,
    ) {}
}
