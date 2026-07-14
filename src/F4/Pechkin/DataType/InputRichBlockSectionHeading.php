<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\Attribute\ArrayOf;

use F4\Pechkin\DataType\{
    InputRichBlock,
    RichText,
};

readonly class InputRichBlockSectionHeading extends InputRichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var RichText|RichText[]|string */
        #[ArrayOf(RichText::class)]
        public readonly RichText|array|string $text,
        public readonly int $size, // 1 - 6, 1 largest
    ) {
        $this->type = 'heading';
    }
}
