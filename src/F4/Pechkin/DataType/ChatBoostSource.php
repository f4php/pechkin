<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    ChatBoostSourcePremium,
    ChatBoostSourceGiftCode,
    ChatBoostSourceGiveaway,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'gift_code' => ChatBoostSourceGiftCode::class,
    'giveaway' => ChatBoostSourceGiveaway::class,
    'premium' => ChatBoostSourcePremium::class,
])]
abstract readonly class ChatBoostSource extends AbstractDataType
{
}
