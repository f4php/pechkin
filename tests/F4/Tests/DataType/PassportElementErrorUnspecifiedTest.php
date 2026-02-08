<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PassportElementErrorUnspecified;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PassportElementErrorUnspecifiedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('passport_element_error_unspecified_full.json');
        $passportElementErrorUnspecified = PassportElementErrorUnspecified::fromArray($data);

        $this->assertInstanceOf(PassportElementErrorUnspecified::class, $passportElementErrorUnspecified);
        $this->assertSame('private', $passportElementErrorUnspecified->type);
        $this->assertSame('element_hash_123', $passportElementErrorUnspecified->element_hash);
        $this->assertSame('Error message', $passportElementErrorUnspecified->message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('passport_element_error_unspecified_minimal.json');
        $passportElementErrorUnspecified = PassportElementErrorUnspecified::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'unspecified'], $passportElementErrorUnspecified->toArray());
    }
}
