<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\StoryAreaTypeLink;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StoryAreaTypeLinkTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('story_area_type_link_full.json');
        $storyAreaTypeLink = StoryAreaTypeLink::fromArray($data);

        $this->assertInstanceOf(StoryAreaTypeLink::class, $storyAreaTypeLink);
        $this->assertSame('https://example.com', $storyAreaTypeLink->url);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('story_area_type_link_minimal.json');
        $storyAreaTypeLink = StoryAreaTypeLink::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'link'], $storyAreaTypeLink->toArray());
    }
}
