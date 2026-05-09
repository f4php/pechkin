<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputPaidMediaLivePhoto,
    InputPaidMediaPhoto,
    InputPaidMediaVideo,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'live_photo' => InputPaidMediaLivePhoto::class,
    'photo' => InputPaidMediaPhoto::class,
    'video' => InputPaidMediaVideo::class,
])]
abstract readonly class InputPaidMedia extends AbstractDataType
{
    public readonly string $type;
}
