<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextSuperscript;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextSuperscriptTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_superscript_full.json');
        $obj = RichTextSuperscript::fromArray($data);

        $this->assertInstanceOf(RichTextSuperscript::class, $obj);
        $this->assertSame('superscript', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_superscript_full.json');
        $obj = RichTextSuperscript::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'superscript'], $obj->toArray());
    }
}
