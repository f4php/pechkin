<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\Gift;
use F4\Pechkin\DataType\GiftBackground;
use F4\Pechkin\DataType\Sticker;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GiftTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('gift_full.json');
        $gift = Gift::fromArray($data);

        $this->assertInstanceOf(Gift::class, $gift);
        $this->assertInstanceOf(Sticker::class, $gift->sticker);
        $this->assertInstanceOf(GiftBackground::class, $gift->background);
        $this->assertInstanceOf(Chat::class, $gift->publisher_chat);
        $this->assertSame('123456789', $gift->id);
        $this->assertSame(100, $gift->star_count);
        $this->assertSame(50, $gift->upgrade_star_count);
        $this->assertSame(true, $gift->is_premium);
        $this->assertSame(true, $gift->has_colors);
        $this->assertSame(10, $gift->total_count);
        $this->assertSame(42, $gift->remaining_count);
        $this->assertSame(42, $gift->personal_total_count);
        $this->assertSame(42, $gift->personal_remaining_count);
        $this->assertSame(42, $gift->unique_gift_variant_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('gift_minimal.json');
        $gift = Gift::fromArray($data);

        $this->assertInstanceOf(Gift::class, $gift);
        $this->assertNull($gift->upgrade_star_count);
        $this->assertNull($gift->is_premium);
        $this->assertNull($gift->has_colors);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('gift_minimal.json');
        $gift = Gift::fromArray($data);
        $this->assertEquals($data, $gift->toArray());
    }
}
