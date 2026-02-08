<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatBoostSourceGiftCode;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatBoostSourceGiftCodeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_boost_source_gift_code_full.json');
        $chatBoostSourceGiftCode = ChatBoostSourceGiftCode::fromArray($data);

        $this->assertInstanceOf(ChatBoostSourceGiftCode::class, $chatBoostSourceGiftCode);
        $this->assertInstanceOf(User::class, $chatBoostSourceGiftCode->user);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_boost_source_gift_code_minimal.json');
        $chatBoostSourceGiftCode = ChatBoostSourceGiftCode::fromArray($data);
        $this->assertEquals([...$data, 'source' => 'gift_code'], $chatBoostSourceGiftCode->toArray());
    }
}
