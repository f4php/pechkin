<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextStrikethrough;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextStrikethroughTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_strikethrough_full.json');
        $obj = RichTextStrikethrough::fromArray($data);

        $this->assertInstanceOf(RichTextStrikethrough::class, $obj);
        $this->assertSame('strikethrough', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_strikethrough_full.json');
        $obj = RichTextStrikethrough::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'strikethrough'], $obj->toArray());
    }
}
