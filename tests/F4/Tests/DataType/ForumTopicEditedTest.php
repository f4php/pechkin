<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ForumTopicEdited;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ForumTopicEditedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('forum_topic_edited_full.json');
        $forumTopicEdited = ForumTopicEdited::fromArray($data);

        $this->assertInstanceOf(ForumTopicEdited::class, $forumTopicEdited);
        $this->assertSame('Test Name', $forumTopicEdited->name);
        $this->assertSame('emoji_123', $forumTopicEdited->icon_custom_emoji_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('forum_topic_edited_minimal.json');
        $forumTopicEdited = ForumTopicEdited::fromArray($data);

        $this->assertInstanceOf(ForumTopicEdited::class, $forumTopicEdited);
        $this->assertNull($forumTopicEdited->name);
        $this->assertNull($forumTopicEdited->icon_custom_emoji_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('forum_topic_edited_minimal.json');
        $forumTopicEdited = ForumTopicEdited::fromArray($data);
        $this->assertEquals($data, $forumTopicEdited->toArray());
    }
}
