<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Chat,
    User,
    WidgetQueryType,
};

readonly class WidgetQuery extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly User $from,
        public readonly string $chat_instance,
        public readonly WidgetQueryType $type,
        public readonly string $data,
        public readonly ?Chat $chat = null,
        public readonly ?int $message_id = null,
        public readonly ?string $inline_message_id = null,
        public readonly ?string $chat_type = null,
        public readonly ?string $widget_id = null,
    ) {}
}
