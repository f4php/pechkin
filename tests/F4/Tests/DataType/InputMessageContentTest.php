<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Pechkin\DataType\InputTextMessageContent;
use F4\Pechkin\DataType\InputLocationMessageContent;
use F4\Pechkin\DataType\InputVenueMessageContent;
use F4\Pechkin\DataType\InputContactMessageContent;
use F4\Pechkin\DataType\InputInvoiceMessageContent;

final class InputMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithTextContent(): void
    {
        $data = $this->loadFixture('input_text_message_content_full.json');
        $result = InputMessageContent::fromArray($data);
        $this->assertInstanceOf(InputTextMessageContent::class, $result);
    }

    public function testFromArrayWithLocationContent(): void
    {
        $data = $this->loadFixture('input_location_message_content_full.json');
        $result = InputMessageContent::fromArray($data);
        $this->assertInstanceOf(InputLocationMessageContent::class, $result);
    }

    public function testFromArrayWithVenueContent(): void
    {
        $data = $this->loadFixture('input_venue_message_content_full.json');
        $result = InputMessageContent::fromArray($data);
        $this->assertInstanceOf(InputVenueMessageContent::class, $result);
    }

    public function testFromArrayWithContactContent(): void
    {
        $data = $this->loadFixture('input_contact_message_content_full.json');
        $result = InputMessageContent::fromArray($data);
        $this->assertInstanceOf(InputContactMessageContent::class, $result);
    }

    public function testFromArrayWithInvoiceContent(): void
    {
        $data = $this->loadFixture('input_invoice_message_content_full.json');
        $result = InputMessageContent::fromArray($data);
        $this->assertInstanceOf(InputInvoiceMessageContent::class, $result);
    }
}
