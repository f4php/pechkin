<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\DirectMessagePriceChanged;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class DirectMessagePriceChangedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('direct_message_price_changed_full.json');
        $directMessagePriceChanged = DirectMessagePriceChanged::fromArray($data);

        $this->assertInstanceOf(DirectMessagePriceChanged::class, $directMessagePriceChanged);
        $this->assertSame(true, $directMessagePriceChanged->are_direct_messages_enabled);
        $this->assertSame(42, $directMessagePriceChanged->direct_message_star_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('direct_message_price_changed_minimal.json');
        $directMessagePriceChanged = DirectMessagePriceChanged::fromArray($data);

        $this->assertInstanceOf(DirectMessagePriceChanged::class, $directMessagePriceChanged);
        $this->assertNull($directMessagePriceChanged->direct_message_star_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('direct_message_price_changed_minimal.json');
        $directMessagePriceChanged = DirectMessagePriceChanged::fromArray($data);
        $this->assertEquals($data, $directMessagePriceChanged->toArray());
    }
}
