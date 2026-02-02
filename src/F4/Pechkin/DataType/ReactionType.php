<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

// Union type: ReactionTypeEmoji | ReactionTypeCustomEmoji | ReactionTypePaid
abstract readonly class ReactionType extends AbstractDataType
{
}
