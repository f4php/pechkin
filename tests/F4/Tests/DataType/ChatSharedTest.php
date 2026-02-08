<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatShared;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatSharedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_shared_full.json');
        $chatShared = ChatShared::fromArray($data);

        $this->assertInstanceOf(ChatShared::class, $chatShared);
        $this->assertNotEmpty($chatShared->photo);
        $this->assertSame(12345, $chatShared->request_id);
        $this->assertSame('-1001234567890', $chatShared->chat_id);
        $this->assertSame('Test Title', $chatShared->title);
        $this->assertSame('johndoe', $chatShared->username);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_shared_minimal.json');
        $chatShared = ChatShared::fromArray($data);

        $this->assertInstanceOf(ChatShared::class, $chatShared);
        $this->assertNull($chatShared->title);
        $this->assertNull($chatShared->username);
        $this->assertNull($chatShared->photo);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_shared_minimal.json');
        $chatShared = ChatShared::fromArray($data);
        $this->assertEquals($data, $chatShared->toArray());
    }
}
