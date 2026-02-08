<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultGame;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultGameTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_game_full.json');
        $inlineQueryResultGame = InlineQueryResultGame::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultGame::class, $inlineQueryResultGame);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultGame->reply_markup);
        $this->assertSame('123456789', $inlineQueryResultGame->id);
        $this->assertSame('testgame', $inlineQueryResultGame->game_short_name);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_game_minimal.json');
        $inlineQueryResultGame = InlineQueryResultGame::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultGame::class, $inlineQueryResultGame);
        $this->assertNull($inlineQueryResultGame->reply_markup);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_game_minimal.json');
        $inlineQueryResultGame = InlineQueryResultGame::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'game'], $inlineQueryResultGame->toArray());
    }
}
