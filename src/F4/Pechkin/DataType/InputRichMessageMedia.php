<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputMedia,
};

readonly class InputRichMessageMedia extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        // documented as InputMediaAnimation, InputMediaAudio, InputMediaPhoto,
        // InputMediaVideo, or InputMediaVoiceNote; typed as the wider InputMedia
        // base since those are all InputMedia* subtypes
        public readonly InputMedia $media,
    ) {}
}
