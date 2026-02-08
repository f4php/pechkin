<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\GameHighScore;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GameHighScoreTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('game_high_score_full.json');
        $gameHighScore = GameHighScore::fromArray($data);

        $this->assertInstanceOf(GameHighScore::class, $gameHighScore);
        $this->assertInstanceOf(User::class, $gameHighScore->user);
        $this->assertSame(1, $gameHighScore->position);
        $this->assertSame(100, $gameHighScore->score);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('game_high_score_minimal.json');
        $gameHighScore = GameHighScore::fromArray($data);
        $this->assertEquals($data, $gameHighScore->toArray());
    }
}
