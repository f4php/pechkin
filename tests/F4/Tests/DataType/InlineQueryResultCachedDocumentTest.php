<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultCachedDocument;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultCachedDocumentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_document_full.json');
        $inlineQueryResultCachedDocument = InlineQueryResultCachedDocument::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedDocument::class, $inlineQueryResultCachedDocument);
        $this->assertNotEmpty($inlineQueryResultCachedDocument->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultCachedDocument->reply_markup);
        $this->assertNotNull($inlineQueryResultCachedDocument->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultCachedDocument->id);
        $this->assertSame('Test Title', $inlineQueryResultCachedDocument->title);
        $this->assertSame('test_string', $inlineQueryResultCachedDocument->document_file_id);
        $this->assertSame('Test description', $inlineQueryResultCachedDocument->description);
        $this->assertSame('Test caption', $inlineQueryResultCachedDocument->caption);
        $this->assertSame('HTML', $inlineQueryResultCachedDocument->parse_mode);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultCachedDocument->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_document_minimal.json');
        $inlineQueryResultCachedDocument = InlineQueryResultCachedDocument::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedDocument::class, $inlineQueryResultCachedDocument);
        $this->assertNull($inlineQueryResultCachedDocument->description);
        $this->assertNull($inlineQueryResultCachedDocument->caption);
        $this->assertNull($inlineQueryResultCachedDocument->parse_mode);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_document_minimal.json');
        $inlineQueryResultCachedDocument = InlineQueryResultCachedDocument::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'document'], $inlineQueryResultCachedDocument->toArray());
    }
}
