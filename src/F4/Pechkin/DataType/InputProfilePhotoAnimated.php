<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\InputProfilePhoto;

readonly class InputProfilePhotoAnimated extends InputProfilePhoto
{
    public readonly string $type;
    public function __construct(
        public readonly string $animation,
        public readonly ?float $main_frame_timestamp = null,
    ) {
        $this->type = 'animated';
    }
}
