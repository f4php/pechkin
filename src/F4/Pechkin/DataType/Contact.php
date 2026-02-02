<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class Contact extends AbstractDataType
{
    public function __construct(
        public readonly string $phone_number,
        public readonly string $first_name,
        public readonly ?string $last_name = null,
        public readonly ?string $user_id = null,
        public readonly ?string $vcard = null,
    ) {}
}
