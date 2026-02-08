<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ForumTopicCreated;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ForumTopicCreatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('forum_topic_created_full.json');
        $forumTopicCreated = ForumTopicCreated::fromArray($data);

        $this->assertInstanceOf(ForumTopicCreated::class, $forumTopicCreated);
        $this->assertSame('Test Name', $forumTopicCreated->name);
        $this->assertSame(16711680, $forumTopicCreated->icon_color);
        $this->assertSame('emoji_123', $forumTopicCreated->icon_custom_emoji_id);
        $this->assertSame(true, $forumTopicCreated->is_name_implicit);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('forum_topic_created_minimal.json');
        $forumTopicCreated = ForumTopicCreated::fromArray($data);

        $this->assertInstanceOf(ForumTopicCreated::class, $forumTopicCreated);
        $this->assertNull($forumTopicCreated->icon_custom_emoji_id);
        $this->assertNull($forumTopicCreated->is_name_implicit);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('forum_topic_created_minimal.json');
        $forumTopicCreated = ForumTopicCreated::fromArray($data);
        $this->assertEquals($data, $forumTopicCreated->toArray());
    }
}
