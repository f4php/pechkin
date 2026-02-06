<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    StoryAreaTypeLink,
    StoryAreaTypeLocation,
    StoryAreaTypeSuggestedReaction,
    StoryAreaTypeUniqueGift,
    StoryAreaTypeWeather,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'location' => StoryAreaTypeLocation::class,
    'weather' => StoryAreaTypeWeather::class,
    'suggested_reaction' => StoryAreaTypeSuggestedReaction::class,
    'unique_gift' => StoryAreaTypeUniqueGift::class,
    'link' => StoryAreaTypeLink::class,
])]
abstract readonly class StoryAreaType extends AbstractDataType
{
}
