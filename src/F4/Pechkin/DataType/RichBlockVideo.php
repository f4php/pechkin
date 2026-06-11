<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    RichBlockCaption,
    Video,
};

readonly class RichBlockVideo extends RichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly Video $video,
        public readonly ?bool $has_spoiler = null,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'video';
    }
}
