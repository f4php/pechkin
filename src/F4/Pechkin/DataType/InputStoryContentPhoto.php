<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputStoryContent;

readonly class InputStoryContentPhoto extends InputStoryContent
{
    public readonly string $type;
    public function __construct(
        public readonly string $photo,
    ) {
        $this->type = 'photo';
    }
}
