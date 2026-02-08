<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorFrontSide;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorFrontSideTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_front_side_full.json');
        $passportElementErrorFrontSide = PassportElementErrorFrontSide::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorFrontSide::class, $passportElementErrorFrontSide);
        $this->assertSame('passport', $passportElementErrorFrontSide->type);
        $this->assertSame('file_hash_def', $passportElementErrorFrontSide->file_hash);
        $this->assertSame('Error message', $passportElementErrorFrontSide->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_front_side_minimal.json');
        $passportElementErrorFrontSide = PassportElementErrorFrontSide::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'front_side'], $passportElementErrorFrontSide->toArray());
    }
}
