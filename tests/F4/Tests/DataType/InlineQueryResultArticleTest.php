<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultArticle;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultArticleTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_article_full.json');
        $inlineQueryResultArticle = InlineQueryResultArticle::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultArticle::class, $inlineQueryResultArticle);
        $this->assertNotNull($inlineQueryResultArticle->input_message_content);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultArticle->reply_markup);
        $this->assertSame('123456789', $inlineQueryResultArticle->id);
        $this->assertSame('Test Title', $inlineQueryResultArticle->title);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultArticle->input_message_content);
        $this->assertSame('https://example.com', $inlineQueryResultArticle->url);
        $this->assertSame('Test description', $inlineQueryResultArticle->description);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultArticle->thumbnail_url);
        $this->assertSame(160, $inlineQueryResultArticle->thumbnail_width);
        $this->assertSame(120, $inlineQueryResultArticle->thumbnail_height);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_article_minimal.json');
        $inlineQueryResultArticle = InlineQueryResultArticle::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultArticle::class, $inlineQueryResultArticle);
        $this->assertNull($inlineQueryResultArticle->reply_markup);
        $this->assertNull($inlineQueryResultArticle->url);
        $this->assertNull($inlineQueryResultArticle->description);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_article_minimal.json');
        $inlineQueryResultArticle = InlineQueryResultArticle::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'article'], $inlineQueryResultArticle->toArray());
    }
}
