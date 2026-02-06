<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\AcceptedGiftTypes;

final class AcceptedGiftTypesTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'unlimited_gifts' => true,
            'limited_gifts' => true,
            'unique_gifts' => true,
            'premium_subscription' => true,
            'gifts_from_channels' => true,
        ];
        $types = AcceptedGiftTypes::fromArray($data);
        $this->assertTrue($types->unlimited_gifts);
        $this->assertTrue($types->limited_gifts);
        $this->assertTrue($types->unique_gifts);
        $this->assertTrue($types->premium_subscription);
        $this->assertTrue($types->gifts_from_channels);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data1 = [
            'unlimited_gifts' => true,
            'limited_gifts' => false,
            'unique_gifts' => true,
            'premium_subscription' => false,
            'gifts_from_channels' => true,
        ];
        $data2 = [
            'unlimited_gifts' => false,
            'limited_gifts' => true,
            'unique_gifts' => false,
            'premium_subscription' => true,
            'gifts_from_channels' => false,
        ];
        $types1 = AcceptedGiftTypes::fromArray($data1);
        $types2 = AcceptedGiftTypes::fromArray($data2);
        $this->assertSame($data2, $types2->toArray());
        $this->assertSame($data1, $types1->toArray());
    }
}
