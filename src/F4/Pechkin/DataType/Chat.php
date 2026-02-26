<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
};

use function in_array;

readonly class Chat extends AbstractDataType
{
    public function __construct(
        public readonly string $id, // may not fit in a 32-bit integer
        public readonly string $type,
        public readonly ?string $title = null,
        public readonly ?string $username = null,
        public readonly ?string $first_name = null,
        public readonly ?string $last_name = null,
        public readonly ?bool $is_forum = null,
        public readonly ?bool $is_direct_messages = null,

        // Undocumented property discoverd through API interaction
        public readonly ?bool $all_members_are_administrators = null,
        public readonly ?AcceptedGiftTypes $accepted_gift_types = null,
    )
    {
        if(!in_array(needle: $this->type, haystack: ['private', 'group', 'supergroup', 'channel'], strict: true)) {
            throw new InvalidArgumentException('Unsupported '.__CLASS__.' type');
        }
    }
}
