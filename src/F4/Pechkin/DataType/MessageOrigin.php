<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\AbstractDataType;

// Union type: MessageOriginUser | MessageOriginHiddenUser | MessageOriginChat | MessageOriginChannel
abstract readonly class MessageOrigin extends AbstractDataType
{
}
