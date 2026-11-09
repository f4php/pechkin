<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    TonWalletCard,
    WidgetQueryType,
};

readonly class WidgetQueryTypeData extends WidgetQueryType
{
    public readonly string $type;
    public function __construct(
        public readonly ?TonWalletCard $wallet_card = null,
    ) {
        $this->type = 'data';
    }
}
