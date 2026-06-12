<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextBold;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextBoldTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_bold_full.json');
        $obj = RichTextBold::fromArray($data);

        $this->assertInstanceOf(RichTextBold::class, $obj);
        $this->assertSame('bold', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_bold_full.json');
        $obj = RichTextBold::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'bold'], $obj->toArray());
    }
}
