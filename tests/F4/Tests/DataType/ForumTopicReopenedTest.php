<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ForumTopicReopened;

final class ForumTopicReopenedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $reopened = ForumTopicReopened::fromArray($data);

        $this->assertInstanceOf(ForumTopicReopened::class, $reopened);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $reopened = ForumTopicReopened::fromArray($data);
        $this->assertEquals($data, $reopened->toArray());
    }
}
