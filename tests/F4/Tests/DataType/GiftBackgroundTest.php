<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\GiftBackground;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GiftBackgroundTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('gift_background_full.json');
        $giftBackground = GiftBackground::fromArray($data);

        $this->assertInstanceOf(GiftBackground::class, $giftBackground);
        $this->assertSame(16711680, $giftBackground->center_color);
        $this->assertSame(255, $giftBackground->edge_color);
        $this->assertSame(16777215, $giftBackground->text_color);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('gift_background_minimal.json');
        $giftBackground = GiftBackground::fromArray($data);
        $this->assertEquals($data, $giftBackground->toArray());
    }
}
