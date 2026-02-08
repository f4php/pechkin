<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorReverseSide;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorReverseSideTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_reverse_side_full.json');
        $passportElementErrorReverseSide = PassportElementErrorReverseSide::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorReverseSide::class, $passportElementErrorReverseSide);
        $this->assertSame('driver_license', $passportElementErrorReverseSide->type);
        $this->assertSame('file_hash_def', $passportElementErrorReverseSide->file_hash);
        $this->assertSame('Error message', $passportElementErrorReverseSide->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_reverse_side_minimal.json');
        $passportElementErrorReverseSide = PassportElementErrorReverseSide::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'reverse_side'], $passportElementErrorReverseSide->toArray());
    }
}
