<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    User,
    WidgetQueryType,
};

readonly class SharedWidgetQuery extends AbstractDataType
{
    public function __construct(
        public readonly string $id,
        public readonly User $from,
        public readonly WidgetQueryType $type,
        public readonly string $data,
        public readonly string $widget_id,
    ) {}
}
