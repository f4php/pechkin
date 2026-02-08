<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\EncryptedCredentials;
use F4\Pechkin\DataType\PassportData;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportDataTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_data_full.json');
        $passportData = PassportData::fromArray($data);

        $this->assertInstanceOf(PassportData::class, $passportData);
        $this->assertNotEmpty($passportData->data);
        $this->assertInstanceOf(EncryptedCredentials::class, $passportData->credentials);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_data_minimal.json');
        $passportData = PassportData::fromArray($data);
        $this->assertEquals($data, $passportData->toArray());
    }
}
