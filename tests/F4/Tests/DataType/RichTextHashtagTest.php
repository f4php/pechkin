<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextHashtag;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextHashtagTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_hashtag_full.json');
        $obj = RichTextHashtag::fromArray($data);

        $this->assertInstanceOf(RichTextHashtag::class, $obj);
        $this->assertSame('hashtag', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('telegram', $obj->hashtag);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_hashtag_full.json');
        $obj = RichTextHashtag::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'hashtag'], $obj->toArray());
    }
}
