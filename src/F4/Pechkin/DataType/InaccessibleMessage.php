<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    Chat,
    MaybeInaccessibleMessage,
};

readonly class InaccessibleMessage extends MaybeInaccessibleMessage
{
    public function __construct(
        public readonly Chat $chat,
        public readonly string $message_id,
        public readonly int $date = 0, // always 0 to differentiate from regular messages
    ) {
        if($this->date !== 0) {
            throw new InvalidArgumentException('Date must be equal to 0');
        }
    }
}
