<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\PassportElementError;
use F4\Pechkin\DataType\PassportElementErrorDataField;
use F4\Pechkin\DataType\PassportElementErrorFrontSide;
use F4\Pechkin\DataType\PassportElementErrorReverseSide;
use F4\Pechkin\DataType\PassportElementErrorSelfie;
use F4\Pechkin\DataType\PassportElementErrorFile;
use F4\Pechkin\DataType\PassportElementErrorFiles;
use F4\Pechkin\DataType\PassportElementErrorTranslationFile;
use F4\Pechkin\DataType\PassportElementErrorTranslationFiles;
use F4\Pechkin\DataType\PassportElementErrorUnspecified;

final class PassportElementErrorTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithDataSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_data_field_full.json'),
            'source' => 'data',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorDataField::class, $result);
    }

    public function testFromArrayWithFrontSideSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_front_side_full.json'),
            'source' => 'front_side',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorFrontSide::class, $result);
    }

    public function testFromArrayWithReverseSideSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_reverse_side_full.json'),
            'source' => 'reverse_side',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorReverseSide::class, $result);
    }

    public function testFromArrayWithSelfieSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_selfie_full.json'),
            'source' => 'selfie',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorSelfie::class, $result);
    }

    public function testFromArrayWithFileSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_file_full.json'),
            'source' => 'file',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorFile::class, $result);
    }

    public function testFromArrayWithFilesSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_files_full.json'),
            'source' => 'files',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorFiles::class, $result);
    }

    public function testFromArrayWithTranslationFileSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_translation_file_full.json'),
            'source' => 'translation_file',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorTranslationFile::class, $result);
    }

    public function testFromArrayWithTranslationFilesSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_translation_files_full.json'),
            'source' => 'translation_files',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorTranslationFiles::class, $result);
    }

    public function testFromArrayWithUnspecifiedSource(): void
    {
        $data = [
            ...$this->loadFixture('passport_element_error_unspecified_full.json'),
            'source' => 'unspecified',
        ];
        $result = PassportElementError::fromArray($data);
        $this->assertInstanceOf(PassportElementErrorUnspecified::class, $result);
    }
}
