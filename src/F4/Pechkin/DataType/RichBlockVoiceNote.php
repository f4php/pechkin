<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    RichBlockCaption,
    Voice,
};

readonly class RichBlockVoiceNote extends RichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly Voice $voice_note,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'voice_note';
    }
}
