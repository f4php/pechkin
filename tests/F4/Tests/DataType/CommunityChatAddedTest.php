<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Community;
use F4\Pechkin\DataType\CommunityChatAdded;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class CommunityChatAddedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('community_chat_added_full.json');
        $communityChatAdded = CommunityChatAdded::fromArray($data);

        $this->assertInstanceOf(CommunityChatAdded::class, $communityChatAdded);
        $this->assertInstanceOf(Community::class, $communityChatAdded->community);
        $this->assertSame('9876543210', $communityChatAdded->community->id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('community_chat_added_minimal.json');
        $communityChatAdded = CommunityChatAdded::fromArray($data);

        $this->assertInstanceOf(CommunityChatAdded::class, $communityChatAdded);
        $this->assertInstanceOf(Community::class, $communityChatAdded->community);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('community_chat_added_minimal.json');
        $communityChatAdded = CommunityChatAdded::fromArray($data);
        $this->assertEquals($data, $communityChatAdded->toArray());
    }
}
