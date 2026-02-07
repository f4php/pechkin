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
    'affiliate_program' => TransactionPartnerAffiliateProgram::class,
    'chat' => TransactionPartnerChat::class,
    'fragment' => TransactionPartnerFragment::class,
    'other' => TransactionPartnerOther::class,
    'telegram_ads' => TransactionPartnerTelegramAds::class,
    'telegram_api' => TransactionPartnerTelegramApi::class,
    'user' => TransactionPartnerUser::class,
])]
abstract readonly class TransactionPartner extends AbstractDataType
{
}
