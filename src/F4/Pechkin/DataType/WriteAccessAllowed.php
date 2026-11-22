<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
};

readonly class WriteAccessAllowed extends AbstractDataType
{
    public function __construct(
        public readonly ?bool $from_request = null,
        public readonly ?string $web_app_name = null,
        public readonly ?bool $from_attachment_menu = null,
        public readonly ?User $inviter = null,
    ) {}
}
