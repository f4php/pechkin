<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextAnchor;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextAnchorTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_anchor_full.json');
        $obj = RichTextAnchor::fromArray($data);

        $this->assertInstanceOf(RichTextAnchor::class, $obj);
        $this->assertSame('anchor', $obj->type);
        $this->assertSame('section-1', $obj->name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_anchor_full.json');
        $obj = RichTextAnchor::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'anchor'], $obj->toArray());
    }
}
