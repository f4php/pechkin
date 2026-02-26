<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PaidMediaPhoto,
    PaidMediaPreview,
    PaidMediaVideo,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'photo' => PaidMediaPhoto::class,
    'preview' => PaidMediaPreview::class,
    'video' => PaidMediaVideo::class,
])]
abstract readonly class PaidMedia extends AbstractDataType
{
    public readonly string $type;
}
