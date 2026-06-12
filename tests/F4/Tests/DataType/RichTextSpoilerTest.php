<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextSpoiler;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextSpoilerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_spoiler_full.json');
        $obj = RichTextSpoiler::fromArray($data);

        $this->assertInstanceOf(RichTextSpoiler::class, $obj);
        $this->assertSame('spoiler', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_spoiler_full.json');
        $obj = RichTextSpoiler::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'spoiler'], $obj->toArray());
    }
}
