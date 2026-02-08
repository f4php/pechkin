<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorFiles;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorFilesTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_files_full.json');
        $passportElementErrorFiles = PassportElementErrorFiles::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorFiles::class, $passportElementErrorFiles);
        $this->assertNotEmpty($passportElementErrorFiles->file_hashes);
        $this->assertSame('utility_bill', $passportElementErrorFiles->type);
        $this->assertSame('Error message', $passportElementErrorFiles->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_files_minimal.json');
        $passportElementErrorFiles = PassportElementErrorFiles::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'files'], $passportElementErrorFiles->toArray());
    }
}
