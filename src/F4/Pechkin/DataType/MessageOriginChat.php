<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    Chat,
    MessageOrigin,
};

readonly class MessageOriginChat extends MessageOrigin
{
    public readonly string $type;
    public function __construct(
        public readonly int $date,
        public readonly Chat $sender_chat,
        public readonly ?string $author_signature = null,
    ) {
        $this->type = 'chat';
    }
}
