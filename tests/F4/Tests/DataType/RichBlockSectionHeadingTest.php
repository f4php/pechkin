<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockSectionHeading;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockSectionHeadingTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_section_heading_full.json');
        $obj = RichBlockSectionHeading::fromArray($data);

        $this->assertInstanceOf(RichBlockSectionHeading::class, $obj);
        $this->assertSame('heading', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame(2, $obj->size);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_section_heading_full.json');
        $obj = RichBlockSectionHeading::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'heading'], $obj->toArray());
    }
}
