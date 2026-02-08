<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MessageEntity;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageEntityTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_entity_full.json');
        $messageEntity = MessageEntity::fromArray($data);

        $this->assertInstanceOf(MessageEntity::class, $messageEntity);
        $this->assertInstanceOf(User::class, $messageEntity->user);
        $this->assertSame('bold', $messageEntity->type);
        $this->assertSame(0, $messageEntity->offset);
        $this->assertSame(240, $messageEntity->length);
        $this->assertSame('https://example.com', $messageEntity->url);
        $this->assertSame('test_string', $messageEntity->language);
        $this->assertSame('emoji_456', $messageEntity->custom_emoji_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('message_entity_minimal.json');
        $messageEntity = MessageEntity::fromArray($data);

        $this->assertInstanceOf(MessageEntity::class, $messageEntity);
        $this->assertNull($messageEntity->url);
        $this->assertNull($messageEntity->user);
        $this->assertNull($messageEntity->language);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_entity_minimal.json');
        $messageEntity = MessageEntity::fromArray($data);
        $this->assertEquals($data, $messageEntity->toArray());
    }
}
