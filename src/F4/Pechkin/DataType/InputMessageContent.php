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

#[Polymorphic([

    // '' => InputTextMessageContent::class,
    // '' => InputLocationMessageContent::class,
    // '' => InputVenueMessageContent::class,
    // '' => InputContactMessageContent::class,
    // '' => InputInvoiceMessageContent::class,

])]
abstract readonly class InputMessageContent extends AbstractDataType
{
}
