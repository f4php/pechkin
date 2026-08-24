<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    InputRichBlock,
    RichMessageButton,
    Attribute\ArrayOf,
};

readonly class InputRichBlockButtons extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var RichMessageButton[] 1-8 buttons */
        #[ArrayOf(RichMessageButton::class)]
        public readonly array $buttons,
        public readonly ?string $align = null, // Must be one of “left”, “center”, or “right”.
    ) {
        $this->type = 'buttons';
    }
}
