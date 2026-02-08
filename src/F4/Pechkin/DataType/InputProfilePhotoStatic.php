<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputProfilePhoto;

readonly class InputProfilePhotoStatic extends InputProfilePhoto
{
    public readonly string $type;
    public function __construct(
        public readonly string $photo,
    ) {
        $this->type = 'static';
    }
}
