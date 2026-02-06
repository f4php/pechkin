<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputPaidMediaPhoto,
    InputPaidMediaVideo,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'photo' => InputPaidMediaPhoto::class,
    'video' => InputPaidMediaVideo::class,
])]
abstract readonly class InputPaidMedia extends AbstractDataType
{
}
