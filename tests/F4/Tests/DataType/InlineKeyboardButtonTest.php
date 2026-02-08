<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\CallbackGame;
use F4\Pechkin\DataType\CopyTextButton;
use F4\Pechkin\DataType\InlineKeyboardButton;
use F4\Pechkin\DataType\LoginUrl;
use F4\Pechkin\DataType\SwitchInlineQueryChosenChat;
use F4\Pechkin\DataType\WebAppInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineKeyboardButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_keyboard_button_full.json');
        $inlineKeyboardButton = InlineKeyboardButton::fromArray($data);

        $this->assertInstanceOf(InlineKeyboardButton::class, $inlineKeyboardButton);
        $this->assertInstanceOf(WebAppInfo::class, $inlineKeyboardButton->web_app);
        $this->assertInstanceOf(LoginUrl::class, $inlineKeyboardButton->login_url);
        $this->assertInstanceOf(SwitchInlineQueryChosenChat::class, $inlineKeyboardButton->switch_inline_query_chosen_chat);
        $this->assertInstanceOf(CopyTextButton::class, $inlineKeyboardButton->copy_text);
        $this->assertInstanceOf(CallbackGame::class, $inlineKeyboardButton->callback_game);
        $this->assertSame('Hello, World!', $inlineKeyboardButton->text);
        $this->assertSame('https://example.com', $inlineKeyboardButton->url);
        $this->assertSame('test_string', $inlineKeyboardButton->callback_data);
        $this->assertSame('inline_query', $inlineKeyboardButton->switch_inline_query);
        $this->assertSame('current_chat_query', $inlineKeyboardButton->switch_inline_query_current_chat);
        $this->assertSame(true, $inlineKeyboardButton->pay);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_keyboard_button_minimal.json');
        $inlineKeyboardButton = InlineKeyboardButton::fromArray($data);

        $this->assertInstanceOf(InlineKeyboardButton::class, $inlineKeyboardButton);
        $this->assertNull($inlineKeyboardButton->url);
        $this->assertNull($inlineKeyboardButton->callback_data);
        $this->assertNull($inlineKeyboardButton->web_app);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_keyboard_button_minimal.json');
        $inlineKeyboardButton = InlineKeyboardButton::fromArray($data);
        $this->assertEquals($data, $inlineKeyboardButton->toArray());
    }
}
