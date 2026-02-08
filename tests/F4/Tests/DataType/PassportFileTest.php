<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportFile;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportFileTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_file_full.json');
        $passportFile = PassportFile::fromArray($data);

        $this->assertInstanceOf(PassportFile::class, $passportFile);
        $this->assertSame('BAACAgIAAxkBAAI', $passportFile->file_id);
        $this->assertSame('AgADBAADZqc', $passportFile->file_unique_id);
        $this->assertSame(1024000, $passportFile->file_size);
        $this->assertSame(42, $passportFile->file_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_file_minimal.json');
        $passportFile = PassportFile::fromArray($data);
        $this->assertEquals($data, $passportFile->toArray());
    }
}
