<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatBoostSourcePremium;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatBoostSourcePremiumTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_boost_source_premium_full.json');
        $chatBoostSourcePremium = ChatBoostSourcePremium::fromArray($data);

        $this->assertInstanceOf(ChatBoostSourcePremium::class, $chatBoostSourcePremium);
        $this->assertInstanceOf(User::class, $chatBoostSourcePremium->user);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_boost_source_premium_minimal.json');
        $chatBoostSourcePremium = ChatBoostSourcePremium::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'premium'], $chatBoostSourcePremium->toArray());
    }
}
