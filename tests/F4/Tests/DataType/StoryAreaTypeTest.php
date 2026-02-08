<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\{
    StoryAreaType,
    StoryAreaTypeLink,
    StoryAreaTypeLocation,
    StoryAreaTypeSuggestedReaction,
    StoryAreaTypeWeather,
    StoryAreaTypeUniqueGift,
};

final class StoryAreaTypeTest extends TestCase
{
    use FixtureAwareTrait;


    public function testFromArrayWithLinkType(): void
    {
        $data = [
            ...$this->loadFixture('story_area_type_link_minimal.json'),
            'type' => 'link',
        ];
        $result = StoryAreaType::fromArray($data);
        $this->assertInstanceOf(StoryAreaTypeLink::class, $result);
        $this->assertSame('https://example.com', $result->url);
    }

    public function testFromArrayWithLocationType(): void
    {
        $data = [
            ...$this->loadFixture('story_area_type_location_minimal.json'),
            'type' => 'location',
        ];
        $result = StoryAreaType::fromArray($data);
        $this->assertInstanceOf(StoryAreaTypeLocation::class, $result);
    }

    public function testFromArrayWithSuggestedReactionType(): void
    {
        $data = [
            ...$this->loadFixture('story_area_type_suggested_reaction_minimal.json'),
            'type' => 'suggested_reaction',
        ];
        $result = StoryAreaType::fromArray($data);
        $this->assertInstanceOf(StoryAreaTypeSuggestedReaction::class, $result);
    }

    public function testFromArrayWithWeatherType(): void
    {
        $data = [
            ...$this->loadFixture('story_area_type_weather_minimal.json'),
            'type' => 'weather',
        ];
        $result = StoryAreaType::fromArray($data);
        $this->assertInstanceOf(StoryAreaTypeWeather::class, $result);
    }

    public function testFromArrayWithUniqueGiftType(): void
    {
        $data = [
            ...$this->loadFixture('story_area_type_unique_gift_minimal.json'),
            'type' => 'unique_gift',
        ];
        $result = StoryAreaType::fromArray($data);
        $this->assertInstanceOf(StoryAreaTypeUniqueGift::class, $result);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            ...$this->loadFixture('story_area_type_weather_minimal.json'),
            'type' => 'weather',
        ];
        $result = StoryAreaType::fromArray($data);
        $this->assertEquals($data, $result->toArray());
    }
}
