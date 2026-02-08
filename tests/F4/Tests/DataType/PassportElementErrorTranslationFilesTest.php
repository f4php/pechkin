<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorTranslationFiles;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorTranslationFilesTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_translation_files_full.json');
        $passportElementErrorTranslationFiles = PassportElementErrorTranslationFiles::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorTranslationFiles::class, $passportElementErrorTranslationFiles);
        $this->assertNotEmpty($passportElementErrorTranslationFiles->file_hashes);
        $this->assertSame('passport', $passportElementErrorTranslationFiles->type);
        $this->assertSame('Error message', $passportElementErrorTranslationFiles->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_translation_files_minimal.json');
        $passportElementErrorTranslationFiles = PassportElementErrorTranslationFiles::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'translation_files'], $passportElementErrorTranslationFiles->toArray());
    }
}
