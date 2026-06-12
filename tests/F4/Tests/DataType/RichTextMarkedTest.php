<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextMarked;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextMarkedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_marked_full.json');
        $obj = RichTextMarked::fromArray($data);

        $this->assertInstanceOf(RichTextMarked::class, $obj);
        $this->assertSame('marked', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_marked_full.json');
        $obj = RichTextMarked::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'marked'], $obj->toArray());
    }
}
