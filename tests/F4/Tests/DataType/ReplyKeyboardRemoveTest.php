<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ReplyKeyboardRemove;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ReplyKeyboardRemoveTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('reply_keyboard_remove_full.json');
        $replyKeyboardRemove = ReplyKeyboardRemove::fromArray($data);

        $this->assertInstanceOf(ReplyKeyboardRemove::class, $replyKeyboardRemove);
        $this->assertSame(true, $replyKeyboardRemove->remove_keyboard);
        $this->assertSame(false, $replyKeyboardRemove->selective);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('reply_keyboard_remove_minimal.json');
        $replyKeyboardRemove = ReplyKeyboardRemove::fromArray($data);

        $this->assertInstanceOf(ReplyKeyboardRemove::class, $replyKeyboardRemove);
        $this->assertNull($replyKeyboardRemove->selective);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('reply_keyboard_remove_minimal.json');
        $replyKeyboardRemove = ReplyKeyboardRemove::fromArray($data);
        $this->assertEquals($data, $replyKeyboardRemove->toArray());
    }
}
