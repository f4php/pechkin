<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    Audio,
    RichBlock,
    RichBlockCaption,
};

readonly class RichBlockAudio extends RichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly Audio $audio,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'audio';
    }
}
