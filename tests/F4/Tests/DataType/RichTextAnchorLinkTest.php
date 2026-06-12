<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextAnchorLink;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextAnchorLinkTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_anchor_link_full.json');
        $obj = RichTextAnchorLink::fromArray($data);

        $this->assertInstanceOf(RichTextAnchorLink::class, $obj);
        $this->assertSame('anchor_link', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('section-1', $obj->anchor_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_anchor_link_full.json');
        $obj = RichTextAnchorLink::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'anchor_link'], $obj->toArray());
    }
}
