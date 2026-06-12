<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockDivider;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockDividerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_divider_full.json');
        $obj = RichBlockDivider::fromArray($data);

        $this->assertInstanceOf(RichBlockDivider::class, $obj);
        $this->assertSame('divider', $obj->type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_divider_full.json');
        $obj = RichBlockDivider::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'divider'], $obj->toArray());
    }
}
