<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ForumTopic;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ForumTopicTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('forum_topic_full.json');
        $forumTopic = ForumTopic::fromArray($data);

        $this->assertInstanceOf(ForumTopic::class, $forumTopic);
        $this->assertSame(42, $forumTopic->message_thread_id);
        $this->assertSame('Test Name', $forumTopic->name);
        $this->assertSame(16711680, $forumTopic->icon_color);
        $this->assertSame('emoji_123', $forumTopic->icon_custom_emoji_id);
        $this->assertSame(true, $forumTopic->is_name_implicit);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('forum_topic_minimal.json');
        $forumTopic = ForumTopic::fromArray($data);

        $this->assertInstanceOf(ForumTopic::class, $forumTopic);
        $this->assertNull($forumTopic->icon_custom_emoji_id);
        $this->assertNull($forumTopic->is_name_implicit);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('forum_topic_minimal.json');
        $forumTopic = ForumTopic::fromArray($data);
        $this->assertEquals($data, $forumTopic->toArray());
    }
}
