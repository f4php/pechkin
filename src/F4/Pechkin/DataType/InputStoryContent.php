<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputStoryContentPhoto,
    InputStoryContentVideo,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'photo' => InputStoryContentPhoto::class,
    'video' => InputStoryContentVideo::class,
])]
abstract readonly class InputStoryContent extends AbstractDataType
{
}
