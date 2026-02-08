<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ReactionType;
use F4\Pechkin\DataType\StoryAreaTypeSuggestedReaction;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StoryAreaTypeSuggestedReactionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('story_area_type_suggested_reaction_full.json');
        $storyAreaTypeSuggestedReaction = StoryAreaTypeSuggestedReaction::fromArray($data);

        $this->assertInstanceOf(StoryAreaTypeSuggestedReaction::class, $storyAreaTypeSuggestedReaction);
        $this->assertNotNull($storyAreaTypeSuggestedReaction->reaction_type);
        $this->assertInstanceOf(ReactionType::class, $storyAreaTypeSuggestedReaction->reaction_type);
        $this->assertSame(false, $storyAreaTypeSuggestedReaction->is_dark);
        $this->assertSame(true, $storyAreaTypeSuggestedReaction->is_flipped);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('story_area_type_suggested_reaction_minimal.json');
        $storyAreaTypeSuggestedReaction = StoryAreaTypeSuggestedReaction::fromArray($data);

        $this->assertInstanceOf(StoryAreaTypeSuggestedReaction::class, $storyAreaTypeSuggestedReaction);
        $this->assertNull($storyAreaTypeSuggestedReaction->is_dark);
        $this->assertNull($storyAreaTypeSuggestedReaction->is_flipped);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('story_area_type_suggested_reaction_minimal.json');
        $storyAreaTypeSuggestedReaction = StoryAreaTypeSuggestedReaction::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'suggested_reaction'], $storyAreaTypeSuggestedReaction->toArray());
    }
}
