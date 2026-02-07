<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    Location,
    User,
};

use function
    in_array,
    mb_strlen
;

readonly class InlineQuery extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly User $from,
        public readonly string $query,
        public readonly string $offset,
        public readonly ?string $chat_type = null,
        public readonly ?Location $location = null,
    ) {
        if ($this->chat_type !== null && !in_array(needle: $this->chat_type, haystack: ['sender', 'private', 'group', 'supergroup', 'channel'], strict: true)) {
            throw new InvalidArgumentException('Unsupported ' . __CLASS__ . ' chat type');
        }
        if (mb_strlen($this->query) > 256) {
            throw new InvalidArgumentException('Query length cannot exceed 256 characters');
        }
    }
}
