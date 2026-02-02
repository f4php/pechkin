<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PhotoSize,
};

readonly class ChatShared extends AbstractDataType
{
    public function __construct(
        public readonly int $request_id,
        public readonly string $chat_id, // may not fit in a 32-bit integer
        public readonly ?string $title = null,
        public readonly ?string $username = null,
        /** @var PhotoSize[]|null */
        public readonly ?array $photo = null,
    ) {}
}
