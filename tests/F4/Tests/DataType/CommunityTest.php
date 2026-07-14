<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Community;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class CommunityTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('community_full.json');
        $community = Community::fromArray($data);

        $this->assertInstanceOf(Community::class, $community);
        $this->assertSame('9876543210', $community->id);
        $this->assertSame('My Community', $community->name);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('community_minimal.json');
        $community = Community::fromArray($data);

        $this->assertInstanceOf(Community::class, $community);
        $this->assertSame('9876543210', $community->id);
        $this->assertSame('My Community', $community->name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('community_minimal.json');
        $community = Community::fromArray($data);
        $this->assertEquals($data, $community->toArray());
    }
}
