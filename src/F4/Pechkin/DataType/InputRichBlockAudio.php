<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputMediaAudio,
    InputRichBlock,
    RichBlockCaption,
};

readonly class InputRichBlockAudio extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly InputMediaAudio $audio,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'audio';
    }
}
