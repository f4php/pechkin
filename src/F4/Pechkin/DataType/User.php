<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class User extends AbstractDataType
{
    public function __construct(
        public readonly string $id, // may not fit in a 32-bit integer
        public readonly bool $is_bot,
        public readonly string $first_name,
        public readonly ?string $last_name = null,
        public readonly ?string $username = null,
        public readonly ?string $language_code = null,
        public readonly ?bool $is_premium = null,
        public readonly ?bool $added_to_attachment_menu = null,
    )
    {}
}
