<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatBoostAdded;

final class ChatBoostAddedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = ['boost_count' => 5];
        $boost = ChatBoostAdded::fromArray($data);
        $this->assertSame(5, $boost->boost_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['boost_count' => 15];
        $boost = ChatBoostAdded::fromArray($data);
        $this->assertSame($data, $boost->toArray());
    }
}
