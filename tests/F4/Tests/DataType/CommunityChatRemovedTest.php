<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\CommunityChatRemoved;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class CommunityChatRemovedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('community_chat_removed_full.json');
        $communityChatRemoved = CommunityChatRemoved::fromArray($data);

        $this->assertInstanceOf(CommunityChatRemoved::class, $communityChatRemoved);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('community_chat_removed_minimal.json');
        $communityChatRemoved = CommunityChatRemoved::fromArray($data);
        $this->assertEquals($data, $communityChatRemoved->toArray());
    }
}
