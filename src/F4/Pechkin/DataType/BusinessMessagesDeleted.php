<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    Attribute\ArrayOf,
};

readonly class BusinessMessagesDeleted extends AbstractDataType
{
    public function __construct(
        public readonly string $business_connection_id,
        public readonly Chat $chat,
        /** @var int[] */
        #[ArrayOf('int')]
        public readonly array $message_ids,
    ) {}
}
