<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputInvoiceMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputInvoiceMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_invoice_message_content_full.json');
        $inputInvoiceMessageContent = InputInvoiceMessageContent::fromArray($data);

        $this->assertInstanceOf(InputInvoiceMessageContent::class, $inputInvoiceMessageContent);
        $this->assertNotEmpty($inputInvoiceMessageContent->prices);
        $this->assertNotEmpty($inputInvoiceMessageContent->suggested_tip_amounts);
        $this->assertSame('Test Title', $inputInvoiceMessageContent->title);
        $this->assertSame('Test description', $inputInvoiceMessageContent->description);
        $this->assertSame('test_string', $inputInvoiceMessageContent->payload);
        $this->assertSame('USD', $inputInvoiceMessageContent->currency);
        $this->assertSame('provider_token_test', $inputInvoiceMessageContent->provider_token);
        $this->assertSame(5000, $inputInvoiceMessageContent->max_tip_amount);
        $this->assertSame('{}', $inputInvoiceMessageContent->provider_data);
        $this->assertSame('https://example.com/photo.jpg', $inputInvoiceMessageContent->photo_url);
        $this->assertSame(1024, $inputInvoiceMessageContent->photo_size);
        $this->assertSame(640, $inputInvoiceMessageContent->photo_width);
        $this->assertSame(480, $inputInvoiceMessageContent->photo_height);
        $this->assertSame(false, $inputInvoiceMessageContent->need_name);
        $this->assertSame(false, $inputInvoiceMessageContent->need_phone_number);
        $this->assertSame(false, $inputInvoiceMessageContent->need_email);
        $this->assertSame(false, $inputInvoiceMessageContent->need_shipping_address);
        $this->assertSame(false, $inputInvoiceMessageContent->send_phone_number_to_provider);
        $this->assertSame(false, $inputInvoiceMessageContent->send_email_to_provider);
        $this->assertSame(false, $inputInvoiceMessageContent->is_flexible);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_invoice_message_content_minimal.json');
        $inputInvoiceMessageContent = InputInvoiceMessageContent::fromArray($data);

        $this->assertInstanceOf(InputInvoiceMessageContent::class, $inputInvoiceMessageContent);
        $this->assertNull($inputInvoiceMessageContent->provider_token);
        $this->assertNull($inputInvoiceMessageContent->max_tip_amount);
        $this->assertNull($inputInvoiceMessageContent->suggested_tip_amounts);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_invoice_message_content_minimal.json');
        $inputInvoiceMessageContent = InputInvoiceMessageContent::fromArray($data);
        $this->assertEquals($data, $inputInvoiceMessageContent->toArray());
    }
}
