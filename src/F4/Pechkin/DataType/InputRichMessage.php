<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputRichBlock,
    InputRichMessageMedia,
    Attribute\ArrayOf,
};

readonly class InputRichMessage extends AbstractDataType
{
    public function __construct(
        /** @var InputRichBlock[]|null */
        #[ArrayOf(InputRichBlock::class)]
        public readonly ?array $blocks = null,
        public readonly ?string $html = null,
        public readonly ?string $markdown = null,
        /** @var InputRichMessageMedia[]|null */
        #[ArrayOf(InputRichMessageMedia::class)]
        public readonly ?array $media = null,
        public readonly ?bool $is_rtl = null,
        public readonly ?bool $skip_entity_detection = null,
    ) {}
}
