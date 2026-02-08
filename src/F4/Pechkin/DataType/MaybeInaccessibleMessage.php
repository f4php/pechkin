<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InaccessibleMessage,
    Message,
    Attribute\Polymorphic,
};

#[Polymorphic(
    createFromArray: static function ($data) {
        return match(true) {
            ($data['date']??null) !== 0 => Message::fromArray($data),
            ($data['date']??null) === 0 => InaccessibleMessage::fromArray($data),
            default => null,
        };
    }
)]
abstract readonly class MaybeInaccessibleMessage extends AbstractDataType
{
}
