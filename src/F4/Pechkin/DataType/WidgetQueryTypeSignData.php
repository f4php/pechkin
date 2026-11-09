<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    WidgetQueryType,
    WidgetQueryWallet,
};

readonly class WidgetQueryTypeSignData extends WidgetQueryType
{
    public readonly string $type;
    public function __construct(
        public readonly WidgetQueryWallet $wallet,
        public readonly string $sign_data,
    ) {
        $this->type = 'sign_data';
    }
}
