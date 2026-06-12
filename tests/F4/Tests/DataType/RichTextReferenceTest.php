<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextReference;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextReferenceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_reference_full.json');
        $obj = RichTextReference::fromArray($data);

        $this->assertInstanceOf(RichTextReference::class, $obj);
        $this->assertSame('reference', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('ref-1', $obj->name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_reference_full.json');
        $obj = RichTextReference::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'reference'], $obj->toArray());
    }
}
