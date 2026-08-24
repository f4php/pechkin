<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    RichMessageButton,
    Attribute\ArrayOf,
};

readonly class RichBlockButtons extends RichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var RichMessageButton[] */
        #[ArrayOf(RichMessageButton::class)]
        public readonly array $buttons,
        public readonly ?string $align = null, // Must be one of “left”, “center”, or “right”.
    ) {
        $this->type = 'buttons';
    }
}
