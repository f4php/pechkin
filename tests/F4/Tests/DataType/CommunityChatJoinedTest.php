<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Community;
use F4\Pechkin\DataType\CommunityChatJoined;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class CommunityChatJoinedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('community_chat_joined_full.json');
        $communityChatJoined = CommunityChatJoined::fromArray($data);

        $this->assertInstanceOf(CommunityChatJoined::class, $communityChatJoined);
        $this->assertInstanceOf(Community::class, $communityChatJoined->community);
        $this->assertSame('9876543210', $communityChatJoined->community->id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('community_chat_joined_minimal.json');
        $communityChatJoined = CommunityChatJoined::fromArray($data);

        $this->assertInstanceOf(CommunityChatJoined::class, $communityChatJoined);
        $this->assertInstanceOf(Community::class, $communityChatJoined->community);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('community_chat_joined_minimal.json');
        $communityChatJoined = CommunityChatJoined::fromArray($data);
        $this->assertEquals($data, $communityChatJoined->toArray());
    }
}
