<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextReferenceLink;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextReferenceLinkTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_reference_link_full.json');
        $obj = RichTextReferenceLink::fromArray($data);

        $this->assertInstanceOf(RichTextReferenceLink::class, $obj);
        $this->assertSame('reference_link', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('ref-1', $obj->reference_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_reference_link_full.json');
        $obj = RichTextReferenceLink::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'reference_link'], $obj->toArray());
    }
}
