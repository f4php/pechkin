<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatBoostAdded;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatBoostAddedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_boost_added_full.json');
        $chatBoostAdded = ChatBoostAdded::fromArray($data);

        $this->assertInstanceOf(ChatBoostAdded::class, $chatBoostAdded);
        $this->assertSame(5, $chatBoostAdded->boost_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_boost_added_minimal.json');
        $chatBoostAdded = ChatBoostAdded::fromArray($data);
        $this->assertEquals($data, $chatBoostAdded->toArray());
    }
}
