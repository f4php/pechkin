<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Link;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class LinkTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('link_full.json');
        $link = Link::fromArray($data);

        $this->assertInstanceOf(Link::class, $link);
        $this->assertSame('https://example.com/path?query=1', $link->url);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('link_full.json');
        $link = Link::fromArray($data);
        $this->assertEquals($data, $link->toArray());
    }
}
