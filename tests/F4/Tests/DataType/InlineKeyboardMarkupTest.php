<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineKeyboardMarkupTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_keyboard_markup_full.json');
        $inlineKeyboardMarkup = InlineKeyboardMarkup::fromArray($data);

        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineKeyboardMarkup);
        $this->assertNotEmpty($inlineKeyboardMarkup->inline_keyboard);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_keyboard_markup_minimal.json');
        $inlineKeyboardMarkup = InlineKeyboardMarkup::fromArray($data);
        $this->assertEquals($data, $inlineKeyboardMarkup->toArray());
    }
}
