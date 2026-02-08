<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ReactionCount;
use F4\Pechkin\DataType\ReactionType;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ReactionCountTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('reaction_count_full.json');
        $reactionCount = ReactionCount::fromArray($data);

        $this->assertInstanceOf(ReactionCount::class, $reactionCount);
        $this->assertNotNull($reactionCount->type);
        $this->assertInstanceOf(ReactionType::class, $reactionCount->type);
        $this->assertSame(10, $reactionCount->total_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('reaction_count_minimal.json');
        $reactionCount = ReactionCount::fromArray($data);
        $this->assertEquals($data, $reactionCount->toArray());
    }
}
