<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class LoginUrl extends AbstractDataType
{
    public function __construct(
        public readonly string $url,
        public readonly ?string $forward_text = null,
        public readonly ?string $bot_username = null,
        public readonly ?bool $request_write_access = null,
    ) {}
}
