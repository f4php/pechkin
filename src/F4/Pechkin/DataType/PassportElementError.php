<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    PassportElementErrorDataField,
    PassportElementErrorFile,
    PassportElementErrorFiles,
    PassportElementErrorFrontSide,
    PassportElementErrorReverseSide,
    PassportElementErrorSelfie,
    PassportElementErrorTranslationFile,
    PassportElementErrorTranslationFiles,
    PassportElementErrorUnspecified,
    Attribute\Polymorphic,
};

#[Polymorphic(
    discriminator: 'source',
    map :[
        'data' => PassportElementErrorDataField::class,
        'file' => PassportElementErrorFile::class,
        'files' => PassportElementErrorFiles::class,
        'front_side' => PassportElementErrorFrontSide::class,
        'reverse_side' => PassportElementErrorReverseSide::class,
        'selfie' => PassportElementErrorSelfie::class,
        'translation_file' => PassportElementErrorTranslationFile::class,
        'translation_files' => PassportElementErrorTranslationFiles::class,
        'unspecified' => PassportElementErrorUnspecified::class,
    ],
)]
abstract readonly class PassportElementError extends AbstractDataType
{
    public readonly string $source;
}
