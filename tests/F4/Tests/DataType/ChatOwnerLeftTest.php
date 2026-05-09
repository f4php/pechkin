<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatOwnerLeft;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatOwnerLeftTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_owner_left_full.json');
        $col = ChatOwnerLeft::fromArray($data);

        $this->assertInstanceOf(ChatOwnerLeft::class, $col);
        $this->assertInstanceOf(User::class, $col->new_owner);
        $this->assertSame('123456789', $col->new_owner->id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_owner_left_minimal.json');
        $col = ChatOwnerLeft::fromArray($data);

        $this->assertInstanceOf(ChatOwnerLeft::class, $col);
        $this->assertNull($col->new_owner);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_owner_left_minimal.json');
        $col = ChatOwnerLeft::fromArray($data);
        $this->assertEquals($data, $col->toArray());
    }
}
