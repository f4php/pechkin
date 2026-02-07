<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputContactMessageContent,
    InputInvoiceMessageContent,
    InputLocationMessageContent,
    InputTextMessageContent,
    InputVenueMessageContent,
    Attribute\Polymorphic,
};

#[Polymorphic(
    createFromArray: static function (array $data): mixed {
        return match(true) {
            isset($data['phone_number']) => InputContactMessageContent::fromArray($data),
            isset($data['currency']) => InputInvoiceMessageContent::fromArray($data),
            isset($data['longitude']) && !isset($data['address']) => InputLocationMessageContent::fromArray($data),
            isset($data['message_text']) => InputTextMessageContent::fromArray($data),
            isset($data['address']) => InputVenueMessageContent::fromArray($data),
            default => null
        };
    }
)]
abstract readonly class InputMessageContent extends AbstractDataType
{
}
