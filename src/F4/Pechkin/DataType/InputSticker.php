<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    MaskPosition,
    Attribute\ArrayOf,
};

use function count;

readonly class InputSticker extends AbstractDataType
{
    public function __construct(
        public readonly string $sticker,
        public readonly string $format,
        /** @var string[] */
        #[ArrayOf('string')]
        public readonly string $emoji_list,
        public readonly ?MaskPosition $mask_position = null,
        /** @var string[]|null */
        #[ArrayOf('string')]
        public readonly ?array $keywords = null,
    ) {
        if((null !== $this->keywords) && count($this->keywords) > 20) {
            throw new InvalidArgumentException('Keywords count cannot exceed 20');
        }
    }
}
