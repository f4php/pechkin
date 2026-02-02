<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class KeyboardButtonRequestUsers extends AbstractDataType
{
    public function __construct(
        public readonly int $request_id,
        public readonly ?bool $user_is_bot = null,
        public readonly ?bool $user_is_premium = null,
        public readonly ?int $max_quantity = null,
        public readonly ?bool $request_name = null,
        public readonly ?bool $request_username = null,
        public readonly ?bool $request_photo = null,
    ) {}
}
