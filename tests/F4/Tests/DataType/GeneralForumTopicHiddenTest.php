<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\GeneralForumTopicHidden;

final class GeneralForumTopicHiddenTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $hidden = GeneralForumTopicHidden::fromArray($data);

        $this->assertInstanceOf(GeneralForumTopicHidden::class, $hidden);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $hidden = GeneralForumTopicHidden::fromArray($data);
        $this->assertEquals($data, $hidden->toArray());
    }
}
