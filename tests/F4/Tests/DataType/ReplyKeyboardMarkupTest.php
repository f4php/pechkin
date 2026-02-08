<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ReplyKeyboardMarkup;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ReplyKeyboardMarkupTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('reply_keyboard_markup_full.json');
        $replyKeyboardMarkup = ReplyKeyboardMarkup::fromArray($data);

        $this->assertInstanceOf(ReplyKeyboardMarkup::class, $replyKeyboardMarkup);
        $this->assertNotEmpty($replyKeyboardMarkup->keyboard);
        $this->assertSame(true, $replyKeyboardMarkup->is_persistent);
        $this->assertSame(true, $replyKeyboardMarkup->resize_keyboard);
        $this->assertSame(false, $replyKeyboardMarkup->one_time_keyboard);
        $this->assertSame('Type here...', $replyKeyboardMarkup->input_field_placeholder);
        $this->assertSame(false, $replyKeyboardMarkup->selective);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('reply_keyboard_markup_minimal.json');
        $replyKeyboardMarkup = ReplyKeyboardMarkup::fromArray($data);

        $this->assertInstanceOf(ReplyKeyboardMarkup::class, $replyKeyboardMarkup);
        $this->assertNull($replyKeyboardMarkup->is_persistent);
        $this->assertNull($replyKeyboardMarkup->resize_keyboard);
        $this->assertNull($replyKeyboardMarkup->one_time_keyboard);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('reply_keyboard_markup_minimal.json');
        $replyKeyboardMarkup = ReplyKeyboardMarkup::fromArray($data);
        $this->assertEquals($data, $replyKeyboardMarkup->toArray());
    }
}
