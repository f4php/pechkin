<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\StoryAreaTypeUniqueGift;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StoryAreaTypeUniqueGiftTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('story_area_type_unique_gift_full.json');
        $storyAreaTypeUniqueGift = StoryAreaTypeUniqueGift::fromArray($data);

        $this->assertInstanceOf(StoryAreaTypeUniqueGift::class, $storyAreaTypeUniqueGift);
        $this->assertSame('Test Name', $storyAreaTypeUniqueGift->name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('story_area_type_unique_gift_minimal.json');
        $storyAreaTypeUniqueGift = StoryAreaTypeUniqueGift::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'unique_gift'], $storyAreaTypeUniqueGift->toArray());
    }
}
