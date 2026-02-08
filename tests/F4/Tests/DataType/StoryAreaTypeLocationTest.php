<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\LocationAddress;
use F4\Pechkin\DataType\StoryAreaTypeLocation;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StoryAreaTypeLocationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('story_area_type_location_full.json');
        $storyAreaTypeLocation = StoryAreaTypeLocation::fromArray($data);

        $this->assertInstanceOf(StoryAreaTypeLocation::class, $storyAreaTypeLocation);
        $this->assertInstanceOf(LocationAddress::class, $storyAreaTypeLocation->address);
        $this->assertSame(55.7558, $storyAreaTypeLocation->latitude);
        $this->assertSame(37.6173, $storyAreaTypeLocation->longitude);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('story_area_type_location_minimal.json');
        $storyAreaTypeLocation = StoryAreaTypeLocation::fromArray($data);

        $this->assertInstanceOf(StoryAreaTypeLocation::class, $storyAreaTypeLocation);
        $this->assertNull($storyAreaTypeLocation->address);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('story_area_type_location_minimal.json');
        $storyAreaTypeLocation = StoryAreaTypeLocation::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'location'], $storyAreaTypeLocation->toArray());
    }
}
