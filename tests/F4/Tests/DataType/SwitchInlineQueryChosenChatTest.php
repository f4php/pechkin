<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\SwitchInlineQueryChosenChat;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SwitchInlineQueryChosenChatTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('switch_inline_query_chosen_chat_full.json');
        $switchInlineQueryChosenChat = SwitchInlineQueryChosenChat::fromArray($data);

        $this->assertInstanceOf(SwitchInlineQueryChosenChat::class, $switchInlineQueryChosenChat);
        $this->assertSame('test query', $switchInlineQueryChosenChat->query);
        $this->assertSame(true, $switchInlineQueryChosenChat->allow_user_chats);
        $this->assertSame(true, $switchInlineQueryChosenChat->allow_bot_chats);
        $this->assertSame(true, $switchInlineQueryChosenChat->allow_group_chats);
        $this->assertSame(true, $switchInlineQueryChosenChat->allow_channel_chats);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('switch_inline_query_chosen_chat_minimal.json');
        $switchInlineQueryChosenChat = SwitchInlineQueryChosenChat::fromArray($data);

        $this->assertInstanceOf(SwitchInlineQueryChosenChat::class, $switchInlineQueryChosenChat);
        $this->assertNull($switchInlineQueryChosenChat->query);
        $this->assertNull($switchInlineQueryChosenChat->allow_user_chats);
        $this->assertNull($switchInlineQueryChosenChat->allow_bot_chats);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('switch_inline_query_chosen_chat_minimal.json');
        $switchInlineQueryChosenChat = SwitchInlineQueryChosenChat::fromArray($data);
        $this->assertEquals($data, $switchInlineQueryChosenChat->toArray());
    }
}
