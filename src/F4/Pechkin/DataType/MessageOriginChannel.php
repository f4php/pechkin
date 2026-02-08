<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    Chat,
    MessageOrigin,
};

readonly class MessageOriginChannel extends MessageOrigin
{
    public readonly string $type;
    public function __construct(
        public readonly int $date,
        public readonly Chat $chat,
        public readonly int $message_id,
        public readonly ?string $author_signature = null,
    ) {
        $this->type = 'channel';
    }
}
