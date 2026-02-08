<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\EncryptedPassportElement;
use F4\Pechkin\DataType\PassportFile;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class EncryptedPassportElementTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('encrypted_passport_element_full.json');
        $encryptedPassportElement = EncryptedPassportElement::fromArray($data);

        $this->assertInstanceOf(EncryptedPassportElement::class, $encryptedPassportElement);
        $this->assertNotEmpty($encryptedPassportElement->files);
        $this->assertInstanceOf(PassportFile::class, $encryptedPassportElement->front_side);
        $this->assertInstanceOf(PassportFile::class, $encryptedPassportElement->reverse_side);
        $this->assertInstanceOf(PassportFile::class, $encryptedPassportElement->selfie);
        $this->assertNotEmpty($encryptedPassportElement->translation);
        $this->assertSame('personal_details', $encryptedPassportElement->type);
        $this->assertSame('hash_value_xyz', $encryptedPassportElement->hash);
        $this->assertSame('callback_data_123', $encryptedPassportElement->data);
        $this->assertSame('+1234567890', $encryptedPassportElement->phone_number);
        $this->assertSame('test@example.com', $encryptedPassportElement->email);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('encrypted_passport_element_minimal.json');
        $encryptedPassportElement = EncryptedPassportElement::fromArray($data);

        $this->assertInstanceOf(EncryptedPassportElement::class, $encryptedPassportElement);
        $this->assertNull($encryptedPassportElement->data);
        $this->assertNull($encryptedPassportElement->phone_number);
        $this->assertNull($encryptedPassportElement->email);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('encrypted_passport_element_minimal.json');
        $encryptedPassportElement = EncryptedPassportElement::fromArray($data);
        $this->assertEquals($data, $encryptedPassportElement->toArray());
    }
}
