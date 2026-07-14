<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockDivider;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockDividerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_divider_full.json');
        $obj = InputRichBlockDivider::fromArray($data);

        $this->assertInstanceOf(InputRichBlockDivider::class, $obj);
        $this->assertSame('divider', $obj->type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_divider_full.json');
        $obj = InputRichBlockDivider::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'divider'], $obj->toArray());
    }
}
