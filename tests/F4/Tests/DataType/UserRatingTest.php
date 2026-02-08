<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UserRating;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UserRatingTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('user_rating_full.json');
        $userRating = UserRating::fromArray($data);

        $this->assertInstanceOf(UserRating::class, $userRating);
        $this->assertSame(42, $userRating->level);
        $this->assertSame(42, $userRating->rating);
        $this->assertSame(42, $userRating->current_level_rating);
        $this->assertSame(42, $userRating->next_level_rating);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('user_rating_minimal.json');
        $userRating = UserRating::fromArray($data);

        $this->assertInstanceOf(UserRating::class, $userRating);
        $this->assertNull($userRating->next_level_rating);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('user_rating_minimal.json');
        $userRating = UserRating::fromArray($data);
        $this->assertEquals($data, $userRating->toArray());
    }
}
