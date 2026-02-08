<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ForumTopicClosed;

final class ForumTopicClosedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $closed = ForumTopicClosed::fromArray($data);

        $this->assertInstanceOf(ForumTopicClosed::class, $closed);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $closed = ForumTopicClosed::fromArray($data);
        $this->assertEquals($data, $closed->toArray());
    }
}
