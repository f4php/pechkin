<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextUnderline;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextUnderlineTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_underline_full.json');
        $obj = RichTextUnderline::fromArray($data);

        $this->assertInstanceOf(RichTextUnderline::class, $obj);
        $this->assertSame('underline', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_underline_full.json');
        $obj = RichTextUnderline::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'underline'], $obj->toArray());
    }
}
