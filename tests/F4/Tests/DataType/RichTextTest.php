<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichText;
use F4\Pechkin\DataType\RichTextBold;
use F4\Pechkin\DataType\RichTextCode;
use F4\Pechkin\DataType\RichTextCustomEmoji;
use F4\Pechkin\DataType\RichTextMathematicalExpression;
use F4\Pechkin\DataType\RichTextMention;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithBoldType(): void
    {
        $data = [
            ...$this->loadFixture('rich_text_bold_full.json'),
            'type' => 'bold',
        ];
        $result = RichText::fromArray($data);
        $this->assertInstanceOf(RichTextBold::class, $result);
    }

    public function testFromArrayWithCodeType(): void
    {
        $data = [
            ...$this->loadFixture('rich_text_code_full.json'),
            'type' => 'code',
        ];
        $result = RichText::fromArray($data);
        $this->assertInstanceOf(RichTextCode::class, $result);
    }

    public function testFromArrayWithMentionType(): void
    {
        $data = [
            ...$this->loadFixture('rich_text_mention_full.json'),
            'type' => 'mention',
        ];
        $result = RichText::fromArray($data);
        $this->assertInstanceOf(RichTextMention::class, $result);
    }

    public function testFromArrayWithCustomEmojiType(): void
    {
        $data = [
            ...$this->loadFixture('rich_text_custom_emoji_full.json'),
            'type' => 'custom_emoji',
        ];
        $result = RichText::fromArray($data);
        $this->assertInstanceOf(RichTextCustomEmoji::class, $result);
    }

    public function testFromArrayWithMathematicalExpressionType(): void
    {
        $data = [
            ...$this->loadFixture('rich_text_mathematical_expression_full.json'),
            'type' => 'mathematical_expression',
        ];
        $result = RichText::fromArray($data);
        $this->assertInstanceOf(RichTextMathematicalExpression::class, $result);
    }
}
