<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

// Union type: StoryAreaTypeLocation | StoryAreaTypeVenue | StoryAreaTypeSuggestedReaction | StoryAreaTypeMessage | StoryAreaTypeLink | etc.
abstract readonly class StoryAreaType extends AbstractDataType
{
}
