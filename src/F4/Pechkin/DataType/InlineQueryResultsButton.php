<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    WebAppInfo,
};

readonly class InlineQueryResultsButton extends AbstractDataType
{
    public function __construct(
        public readonly string $text,
        public readonly ?WebAppInfo $web_app = null,
        public readonly ?string $start_parameter = null,
    ) {
        if(($web_app === null && $start_parameter === null) || ($web_app !== null && $start_parameter !== null)) {
            throw new InvalidArgumentException('Must specify exactly one optional parameter');
        }
        if ((null !== $this->start_parameter) && (mb_strlen($this->start_parameter) > 64)) {
            throw new InvalidArgumentException('Start parameter length cannot exceed 64 characters');
        }
        if ((null !== $this->start_parameter) && (0 === preg_match('~[a-zA-Z0-9_-]+~', $this->start_parameter))) {
            throw new InvalidArgumentException('Invalid start parameter syntax');
        }
    }
}
