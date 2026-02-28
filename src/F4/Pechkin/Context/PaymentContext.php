<?php

declare(strict_types=1);

namespace F4\Pechkin\Context;

use LogicException;
use F4\Pechkin\ClientInterface;
use F4\Pechkin\DataType\{
    PreCheckoutQuery,
    ShippingQuery,
};

class PaymentContext
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly ?ShippingQuery $shipping,
        private readonly ?PreCheckoutQuery $preCheckout,
    ) {}

    public function isShipping(): bool
    {
        return $this->shipping !== null;
    }

    public function isPreCheckout(): bool
    {
        return $this->preCheckout !== null;
    }

    public function payload(): string
    {
        return $this->shipping?->invoice_payload ?? $this->preCheckout->invoice_payload;
    }

    public function acceptShipping(array $shippingOptions): bool
    {
        if ($this->shipping === null) {
            throw new LogicException('acceptShipping() called on a pre-checkout query context.');
        }

        return $this->client->answerShippingQuery(
            shipping_query_id: $this->shipping->id,
            ok: true,
            shipping_options: $shippingOptions,
        );
    }

    public function declineShipping(string $reason): bool
    {
        if ($this->shipping === null) {
            throw new LogicException('declineShipping() called on a pre-checkout query context.');
        }

        return $this->client->answerShippingQuery(
            shipping_query_id: $this->shipping->id,
            ok: false,
            error_message: $reason,
        );
    }

    public function acceptCheckout(): bool
    {
        if ($this->preCheckout === null) {
            throw new LogicException('acceptCheckout() called on a shipping query context.');
        }

        return $this->client->answerPreCheckoutQuery(
            pre_checkout_query_id: $this->preCheckout->id,
            ok: true,
        );
    }

    public function declineCheckout(string $reason): bool
    {
        if ($this->preCheckout === null) {
            throw new LogicException('declineCheckout() called on a shipping query context.');
        }

        return $this->client->answerPreCheckoutQuery(
            pre_checkout_query_id: $this->preCheckout->id,
            ok: false,
            error_message: $reason,
        );
    }

    public function shippingQuery(): ?ShippingQuery
    {
        return $this->shipping;
    }

    public function preCheckoutQuery(): ?PreCheckoutQuery
    {
        return $this->preCheckout;
    }
}
