<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ReactionTypePaid;
use PHPUnit\Framework\TestCase;

final class ReactionTypePaidTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $reactionTypePaid = ReactionTypePaid::fromArray($data);
        $this->assertInstanceOf(ReactionTypePaid::class, $reactionTypePaid);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $reactionTypePaid = ReactionTypePaid::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'paid'], $reactionTypePaid->toArray());
    }
}
