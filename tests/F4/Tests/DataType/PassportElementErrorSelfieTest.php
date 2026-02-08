<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorSelfie;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorSelfieTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_selfie_full.json');
        $passportElementErrorSelfie = PassportElementErrorSelfie::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorSelfie::class, $passportElementErrorSelfie);
        $this->assertSame('passport', $passportElementErrorSelfie->type);
        $this->assertSame('file_hash_def', $passportElementErrorSelfie->file_hash);
        $this->assertSame('Error message', $passportElementErrorSelfie->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_selfie_minimal.json');
        $passportElementErrorSelfie = PassportElementErrorSelfie::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'selfie'], $passportElementErrorSelfie->toArray());
    }
}
