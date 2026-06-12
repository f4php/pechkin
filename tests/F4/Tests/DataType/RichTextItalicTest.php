<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextItalic;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextItalicTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_italic_full.json');
        $obj = RichTextItalic::fromArray($data);

        $this->assertInstanceOf(RichTextItalic::class, $obj);
        $this->assertSame('italic', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_italic_full.json');
        $obj = RichTextItalic::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'italic'], $obj->toArray());
    }
}
