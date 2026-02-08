<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatBoostRemoved;
use F4\Pechkin\DataType\ChatBoostSource;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatBoostRemovedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_boost_removed_full.json');
        $chatBoostRemoved = ChatBoostRemoved::fromArray($data);

        $this->assertInstanceOf(ChatBoostRemoved::class, $chatBoostRemoved);
        $this->assertInstanceOf(Chat::class, $chatBoostRemoved->chat);
        $this->assertNotNull($chatBoostRemoved->source);
        $this->assertSame('boost_123', $chatBoostRemoved->boost_id);
        $this->assertSame(1700086400, $chatBoostRemoved->remove_date);
        $this->assertInstanceOf(ChatBoostSource::class, $chatBoostRemoved->source);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_boost_removed_minimal.json');
        $chatBoostRemoved = ChatBoostRemoved::fromArray($data);
        $this->assertEquals($data, $chatBoostRemoved->toArray());
    }
}
