<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Animation;
use F4\Pechkin\DataType\Game;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('game_full.json');
        $game = Game::fromArray($data);

        $this->assertInstanceOf(Game::class, $game);
        $this->assertNotEmpty($game->photo);
        $this->assertNotEmpty($game->text_entities);
        $this->assertInstanceOf(Animation::class, $game->animation);
        $this->assertSame('Test Title', $game->title);
        $this->assertSame('Test description', $game->description);
        $this->assertSame('Hello, World!', $game->text);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('game_minimal.json');
        $game = Game::fromArray($data);

        $this->assertInstanceOf(Game::class, $game);
        $this->assertNull($game->text);
        $this->assertNull($game->text_entities);
        $this->assertNull($game->animation);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('game_minimal.json');
        $game = Game::fromArray($data);
        $this->assertEquals($data, $game->toArray());
    }
}
