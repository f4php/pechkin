<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AffiliateInfo,
    Gift,
    PaidMedia,
    PaidMediaPhoto,
    PaidMediaPreview,
    PaidMediaVideo,
    TransactionPartner,
    User,
    Attribute\ArrayOf,
    Attribute\Polymorphic,
};

readonly class TransactionPartnerUser extends TransactionPartner
{
    public function __construct(
        public readonly string $transaction_type,
        public readonly User $user,
        public readonly ?AffiliateInfo $affiliate = null,
        public readonly ?string $invoice_payload = null,
        public readonly ?int $subscription_period = null,
        /** @var PaidMedia[] */
        #[ArrayOf(new Polymorphic([
            'photo' => PaidMediaPhoto::class,
            'preview' => PaidMediaPreview::class,
            'video' => PaidMediaVideo::class,
        ]))]
        public readonly ?array $paid_media = null,
        public readonly ?string $paid_media_payload = null,
        public readonly ?Gift $gift = null,
        public readonly ?int $premium_subscription_duration = null,
    ) {}
}
