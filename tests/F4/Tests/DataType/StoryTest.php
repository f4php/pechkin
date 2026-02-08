<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\Story;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StoryTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('story_full.json');
        $story = Story::fromArray($data);

        $this->assertInstanceOf(Story::class, $story);
        $this->assertInstanceOf(Chat::class, $story->chat);
        $this->assertSame(123456789, $story->id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('story_minimal.json');
        $story = Story::fromArray($data);
        $this->assertEquals($data, $story->toArray());
    }
}
