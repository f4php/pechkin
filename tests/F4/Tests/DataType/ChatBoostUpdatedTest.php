<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatBoost;
use F4\Pechkin\DataType\ChatBoostUpdated;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatBoostUpdatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_boost_updated_full.json');
        $chatBoostUpdated = ChatBoostUpdated::fromArray($data);

        $this->assertInstanceOf(ChatBoostUpdated::class, $chatBoostUpdated);
        $this->assertInstanceOf(Chat::class, $chatBoostUpdated->chat);
        $this->assertInstanceOf(ChatBoost::class, $chatBoostUpdated->boost);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_boost_updated_minimal.json');
        $chatBoostUpdated = ChatBoostUpdated::fromArray($data);
        $this->assertEquals($data, $chatBoostUpdated->toArray());
    }
}
