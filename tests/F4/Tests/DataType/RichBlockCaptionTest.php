<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockCaption;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockCaptionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_caption_full.json');
        $caption = RichBlockCaption::fromArray($data);

        $this->assertInstanceOf(RichBlockCaption::class, $caption);
        $this->assertInstanceOf(RichText::class, $caption->text);
        $this->assertInstanceOf(RichText::class, $caption->credit);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_caption_minimal.json');
        $caption = RichBlockCaption::fromArray($data);

        $this->assertInstanceOf(RichBlockCaption::class, $caption);
        $this->assertInstanceOf(RichText::class, $caption->text);
        $this->assertNull($caption->credit);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_caption_minimal.json');
        $caption = RichBlockCaption::fromArray($data);
        $this->assertEquals($data, $caption->toArray());
    }
}
