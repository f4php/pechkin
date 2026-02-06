<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InaccessibleMessage,
    Message,
    Attribute\Polymorphic,
};

#[Polymorphic([
    // '' => InaccessibleMessage::class,
    // '' => Message::class,
])]
abstract readonly class MaybeInaccessibleMessage extends AbstractDataType
{
}
