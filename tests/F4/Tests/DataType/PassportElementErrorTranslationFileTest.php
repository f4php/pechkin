<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorTranslationFile;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorTranslationFileTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_translation_file_full.json');
        $passportElementErrorTranslationFile = PassportElementErrorTranslationFile::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorTranslationFile::class, $passportElementErrorTranslationFile);
        $this->assertSame('passport', $passportElementErrorTranslationFile->type);
        $this->assertSame('file_hash_def', $passportElementErrorTranslationFile->file_hash);
        $this->assertSame('Error message', $passportElementErrorTranslationFile->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_translation_file_minimal.json');
        $passportElementErrorTranslationFile = PassportElementErrorTranslationFile::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'translation_file'], $passportElementErrorTranslationFile->toArray());
    }
}
