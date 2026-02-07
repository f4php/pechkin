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
    'link' => StoryAreaTypeLink::class,
    'location' => StoryAreaTypeLocation::class,
    'suggested_reaction' => StoryAreaTypeSuggestedReaction::class,
    'unique_gift' => StoryAreaTypeUniqueGift::class,
    'weather' => StoryAreaTypeWeather::class,
])]
abstract readonly class StoryAreaType extends AbstractDataType
{
}
