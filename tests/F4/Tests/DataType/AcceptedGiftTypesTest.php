<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\AcceptedGiftTypes;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class AcceptedGiftTypesTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('accepted_gift_types_full.json');
        $acceptedGiftTypes = AcceptedGiftTypes::fromArray($data);

        $this->assertInstanceOf(AcceptedGiftTypes::class, $acceptedGiftTypes);
        $this->assertSame(true, $acceptedGiftTypes->unlimited_gifts);
        $this->assertSame(true, $acceptedGiftTypes->limited_gifts);
        $this->assertSame(true, $acceptedGiftTypes->unique_gifts);
        $this->assertSame(true, $acceptedGiftTypes->premium_subscription);
        $this->assertSame(true, $acceptedGiftTypes->gifts_from_channels);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('accepted_gift_types_minimal.json');
        $acceptedGiftTypes = AcceptedGiftTypes::fromArray($data);
        $this->assertEquals($data, $acceptedGiftTypes->toArray());
    }
}
