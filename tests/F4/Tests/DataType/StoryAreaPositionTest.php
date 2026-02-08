<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\StoryAreaPosition;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StoryAreaPositionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('story_area_position_full.json');
        $storyAreaPosition = StoryAreaPosition::fromArray($data);

        $this->assertInstanceOf(StoryAreaPosition::class, $storyAreaPosition);
        $this->assertSame(50.0, $storyAreaPosition->x_percentage);
        $this->assertSame(50.0, $storyAreaPosition->y_percentage);
        $this->assertSame(20.0, $storyAreaPosition->width_percentage);
        $this->assertSame(15.0, $storyAreaPosition->height_percentage);
        $this->assertSame(45.0, $storyAreaPosition->rotation_angle);
        $this->assertSame(5.0, $storyAreaPosition->corner_radius_percentage);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('story_area_position_minimal.json');
        $storyAreaPosition = StoryAreaPosition::fromArray($data);
        $this->assertEquals($data, $storyAreaPosition->toArray());
    }
}
