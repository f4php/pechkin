<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextTextMention;
use F4\Pechkin\DataType\RichText;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextTextMentionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_text_mention_full.json');
        $obj = RichTextTextMention::fromArray($data);

        $this->assertInstanceOf(RichTextTextMention::class, $obj);
        $this->assertSame('text_mention', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertInstanceOf(User::class, $obj->user);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_text_mention_full.json');
        $obj = RichTextTextMention::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'text_mention'], $obj->toArray());
    }
}
