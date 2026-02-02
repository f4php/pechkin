<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

readonly class BusinessBotRights extends AbstractDataType
{
    public function __construct(
        public readonly bool $can_manage_business_account,
        public readonly bool $can_reply_to_messages,
    ) {}
}
