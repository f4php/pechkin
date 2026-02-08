<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineQuery;
use F4\Pechkin\DataType\Location;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_full.json');
        $inlineQuery = InlineQuery::fromArray($data);

        $this->assertInstanceOf(InlineQuery::class, $inlineQuery);
        $this->assertInstanceOf(User::class, $inlineQuery->from);
        $this->assertInstanceOf(Location::class, $inlineQuery->location);
        $this->assertSame('123456789', $inlineQuery->id);
        $this->assertSame('test query', $inlineQuery->query);
        $this->assertSame('0', $inlineQuery->offset);
        $this->assertSame('sender', $inlineQuery->chat_type);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_minimal.json');
        $inlineQuery = InlineQuery::fromArray($data);

        $this->assertInstanceOf(InlineQuery::class, $inlineQuery);
        $this->assertNull($inlineQuery->chat_type);
        $this->assertNull($inlineQuery->location);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_minimal.json');
        $inlineQuery = InlineQuery::fromArray($data);
        $this->assertEquals($data, $inlineQuery->toArray());
    }
}
