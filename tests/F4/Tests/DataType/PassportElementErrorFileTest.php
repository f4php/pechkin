<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorFile;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorFileTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_file_full.json');
        $passportElementErrorFile = PassportElementErrorFile::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorFile::class, $passportElementErrorFile);
        $this->assertSame('utility_bill', $passportElementErrorFile->type);
        $this->assertSame('file_hash_def', $passportElementErrorFile->file_hash);
        $this->assertSame('Error message', $passportElementErrorFile->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_file_minimal.json');
        $passportElementErrorFile = PassportElementErrorFile::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'file'], $passportElementErrorFile->toArray());
    }
}
