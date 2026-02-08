<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UserChatBoosts;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UserChatBoostsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('user_chat_boosts_full.json');
        $userChatBoosts = UserChatBoosts::fromArray($data);

        $this->assertInstanceOf(UserChatBoosts::class, $userChatBoosts);
        $this->assertNotEmpty($userChatBoosts->boosts);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('user_chat_boosts_minimal.json');
        $userChatBoosts = UserChatBoosts::fromArray($data);
        $this->assertEquals($data, $userChatBoosts->toArray());
    }
}
