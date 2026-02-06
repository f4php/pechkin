<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    TransactionPartnerAffiliateProgram,
    TransactionPartnerChat,
    TransactionPartnerFragment,
    TransactionPartnerOther,
    TransactionPartnerTelegramAds,
    TransactionPartnerTelegramApi,
    TransactionPartnerUser,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'user' => TransactionPartnerUser::class,
    'chat' => TransactionPartnerChat::class,
    'affiliate_program' => TransactionPartnerAffiliateProgram::class,
    'fragment' => TransactionPartnerFragment::class,
    'telegram_ads' => TransactionPartnerTelegramAds::class,
    'telegram_api' => TransactionPartnerTelegramApi::class,
    'other' => TransactionPartnerOther::class,
])]
abstract readonly class TransactionPartner extends AbstractDataType
{
}
