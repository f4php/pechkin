<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatOwnerChanged;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatOwnerChangedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_owner_changed_full.json');
        $coc = ChatOwnerChanged::fromArray($data);

        $this->assertInstanceOf(ChatOwnerChanged::class, $coc);
        $this->assertInstanceOf(User::class, $coc->new_owner);
        $this->assertSame('123456789', $coc->new_owner->id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_owner_changed_minimal.json');
        $coc = ChatOwnerChanged::fromArray($data);
        $this->assertEquals($data, $coc->toArray());
    }
}
