<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatBoost;
use F4\Pechkin\DataType\ChatBoostSource;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatBoostTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_boost_full.json');
        $chatBoost = ChatBoost::fromArray($data);

        $this->assertInstanceOf(ChatBoost::class, $chatBoost);
        $this->assertNotNull($chatBoost->source);
        $this->assertSame('boost_123', $chatBoost->boost_id);
        $this->assertSame(1700000000, $chatBoost->add_date);
        $this->assertSame(1700172800, $chatBoost->expiration_date);
        $this->assertInstanceOf(ChatBoostSource::class, $chatBoost->source);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_boost_minimal.json');
        $chatBoost = ChatBoost::fromArray($data);
        $this->assertEquals($data, $chatBoost->toArray());
    }
}
