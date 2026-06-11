<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    RichBlock,
    RichBlockCaption,
    PhotoSize,
    Attribute\ArrayOf,
};

readonly class RichBlockPhoto extends RichBlock
{
    public readonly string $type;
    public function __construct(
        /** @var PhotoSize[] */
        #[ArrayOf(PhotoSize::class)]
        public readonly array $photo,
        public readonly ?bool $has_spoiler = null,
        public readonly ?RichBlockCaption $caption = null,
    ) {
        $this->type = 'photo';
    }
}
