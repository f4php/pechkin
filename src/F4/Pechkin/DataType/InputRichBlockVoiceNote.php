<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    InputMediaVoiceNote,
    RichBlockCaption,
};

readonly class InputRichBlockVoiceNote extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        public readonly InputMediaVoiceNote $voice_note,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'voice_note';
    }
}
