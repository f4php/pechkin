<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextMention;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextMentionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_mention_full.json');
        $obj = RichTextMention::fromArray($data);

        $this->assertInstanceOf(RichTextMention::class, $obj);
        $this->assertSame('mention', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('johndoe', $obj->username);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_mention_full.json');
        $obj = RichTextMention::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'mention'], $obj->toArray());
    }
}
