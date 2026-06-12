<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    MessageEntity,
    PollMedia,
    PollOption,
    Attribute\ArrayOf,
};

use function in_array;

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
        public readonly bool $allows_revoting,
        public readonly bool $members_only,
        /** @var string[]|null */
        #[ArrayOf('string')]
        public readonly ?array $country_codes = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $question_entities = null,
        // public readonly ?int $correct_option_id = null, // support dropped in ver 9.6
        /** @var int[]|null */
        #[ArrayOf('int')]
        public readonly ?array $correct_option_ids = null,
        public readonly ?string $explanation = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $explanation_entities = null,
        public readonly ?PollMedia $explanation_media = null,
        public readonly ?int $open_period = null,
        public readonly ?int $close_date = null,
        public readonly ?string $description = null,
        /** @var MessageEntity[]|null */
        #[ArrayOf(MessageEntity::class)]
        public readonly ?array $description_entities = null,
        public readonly ?PollMedia $media = null,
    ) {
        if(!in_array(needle: $this->type, haystack: ['regular', 'quiz'], strict: true)) {
            throw new InvalidArgumentException('Unsupported '.__CLASS__.' type');
        }
    }
}
