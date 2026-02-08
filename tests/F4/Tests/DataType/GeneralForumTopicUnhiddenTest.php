<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\GeneralForumTopicUnhidden;

final class GeneralForumTopicUnhiddenTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $unhidden = GeneralForumTopicUnhidden::fromArray($data);

        $this->assertInstanceOf(GeneralForumTopicUnhidden::class, $unhidden);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $unhidden = GeneralForumTopicUnhidden::fromArray($data);
        $this->assertEquals($data, $unhidden->toArray());
    }
}
