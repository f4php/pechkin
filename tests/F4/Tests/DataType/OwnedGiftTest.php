<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\OwnedGift;
use F4\Pechkin\DataType\OwnedGiftRegular;
use F4\Pechkin\DataType\OwnedGiftUnique;

final class OwnedGiftTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithRegularType(): void
    {
        $data = [
            ...$this->loadFixture('owned_gift_regular_full.json'),
            'type' => 'regular',
        ];
        $result = OwnedGift::fromArray($data);
        $this->assertInstanceOf(OwnedGiftRegular::class, $result);
    }

    public function testFromArrayWithUniqueType(): void
    {
        $data = [
            ...$this->loadFixture('owned_gift_unique_full.json'),
            'type' => 'unique',
        ];
        $result = OwnedGift::fromArray($data);
        $this->assertInstanceOf(OwnedGiftUnique::class, $result);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            ...$this->loadFixture('owned_gift_regular_minimal.json'),
            'type' => 'regular',
        ];
        $result = OwnedGift::fromArray($data);
        $this->assertEquals($data, $result->toArray());
    }
}
