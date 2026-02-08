<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\DirectMessagesTopic;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class DirectMessagesTopicTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('direct_messages_topic_full.json');
        $directMessagesTopic = DirectMessagesTopic::fromArray($data);

        $this->assertInstanceOf(DirectMessagesTopic::class, $directMessagesTopic);
        $this->assertInstanceOf(User::class, $directMessagesTopic->user);
        $this->assertSame('test_string', $directMessagesTopic->topic_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('direct_messages_topic_minimal.json');
        $directMessagesTopic = DirectMessagesTopic::fromArray($data);
        $this->assertEquals($data, $directMessagesTopic->toArray());
    }
}
