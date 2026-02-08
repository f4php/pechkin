<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\CallbackQuery;
use F4\Pechkin\DataType\MaybeInaccessibleMessage;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class CallbackQueryTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('callback_query_full.json');
        $callbackQuery = CallbackQuery::fromArray($data);

        $this->assertInstanceOf(CallbackQuery::class, $callbackQuery);
        $this->assertInstanceOf(User::class, $callbackQuery->from);
        $this->assertNotNull($callbackQuery->message);
        $this->assertSame('123456789', $callbackQuery->id);
        $this->assertSame('test_string', $callbackQuery->chat_instance);
        $this->assertInstanceOf(MaybeInaccessibleMessage::class, $callbackQuery->message);
        $this->assertSame('inline_msg_123', $callbackQuery->inline_message_id);
        $this->assertSame('callback_data_123', $callbackQuery->data);
        $this->assertSame('testgame', $callbackQuery->game_short_name);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('callback_query_minimal.json');
        $callbackQuery = CallbackQuery::fromArray($data);

        $this->assertInstanceOf(CallbackQuery::class, $callbackQuery);
        $this->assertNull($callbackQuery->message);
        $this->assertNull($callbackQuery->inline_message_id);
        $this->assertNull($callbackQuery->data);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('callback_query_minimal.json');
        $callbackQuery = CallbackQuery::fromArray($data);
        $this->assertEquals($data, $callbackQuery->toArray());
    }
}
