<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    InputMediaVideo,
    RichBlockCaption,
};

readonly class InputRichBlockVideo extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly InputMediaVideo $video,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'video';
    }
}
