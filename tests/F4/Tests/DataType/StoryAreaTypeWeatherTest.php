<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\StoryAreaTypeWeather;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StoryAreaTypeWeatherTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('story_area_type_weather_full.json');
        $storyAreaTypeWeather = StoryAreaTypeWeather::fromArray($data);

        $this->assertInstanceOf(StoryAreaTypeWeather::class, $storyAreaTypeWeather);
        $this->assertSame(3.14, $storyAreaTypeWeather->temperature);
        $this->assertSame('🎲', $storyAreaTypeWeather->emoji);
        $this->assertSame(42, $storyAreaTypeWeather->background_color);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('story_area_type_weather_minimal.json');
        $storyAreaTypeWeather = StoryAreaTypeWeather::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'weather'], $storyAreaTypeWeather->toArray());
    }
}
