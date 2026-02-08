<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\StoryArea;
use F4\Pechkin\DataType\StoryAreaPosition;
use F4\Pechkin\DataType\StoryAreaTypeLink;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StoryAreaTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('story_area_full.json');
        $storyArea = StoryArea::fromArray($data);

        $this->assertInstanceOf(StoryArea::class, $storyArea);
        $this->assertInstanceOf(StoryAreaPosition::class, $storyArea->position);
        $this->assertInstanceOf(StoryAreaTypeLink::class, $storyArea->type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('story_area_minimal.json');
        $storyArea = StoryArea::fromArray($data);
        $this->assertEquals($data, $storyArea->toArray());
    }
}
