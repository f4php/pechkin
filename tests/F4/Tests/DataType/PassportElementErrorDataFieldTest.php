<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorDataField;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorDataFieldTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_data_field_full.json');
        $passportElementErrorDataField = PassportElementErrorDataField::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorDataField::class, $passportElementErrorDataField);
        $this->assertSame('personal_details', $passportElementErrorDataField->type);
        $this->assertSame('first_name', $passportElementErrorDataField->field_name);
        $this->assertSame('data_hash_abc', $passportElementErrorDataField->data_hash);
        $this->assertSame('Error message', $passportElementErrorDataField->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_data_field_minimal.json');
        $passportElementErrorDataField = PassportElementErrorDataField::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'data'], $passportElementErrorDataField->toArray());
    }
}
