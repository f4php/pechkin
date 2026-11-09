<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    WidgetQueryTypeData,
    WidgetQueryTypeSentTransaction,
    WidgetQueryTypeSignData,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'data' => WidgetQueryTypeData::class,
    'sent_transaction' => WidgetQueryTypeSentTransaction::class,
    'sign_data' => WidgetQueryTypeSignData::class,
])]
abstract readonly class WidgetQueryType extends AbstractDataType
{
    public readonly string $type;
}
