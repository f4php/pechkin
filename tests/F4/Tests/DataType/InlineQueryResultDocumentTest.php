<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultDocument;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultDocumentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_document_full.json');
        $inlineQueryResultDocument = InlineQueryResultDocument::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultDocument::class, $inlineQueryResultDocument);
        $this->assertNotEmpty($inlineQueryResultDocument->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultDocument->reply_markup);
        $this->assertNotNull($inlineQueryResultDocument->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultDocument->id);
        $this->assertSame('Test Title', $inlineQueryResultDocument->title);
        $this->assertSame('https://example.com/document.pdf', $inlineQueryResultDocument->document_url);
        $this->assertSame('application/pdf', $inlineQueryResultDocument->mime_type);
        $this->assertSame('Test caption', $inlineQueryResultDocument->caption);
        $this->assertSame('HTML', $inlineQueryResultDocument->parse_mode);
        $this->assertSame('Test description', $inlineQueryResultDocument->description);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultDocument->input_message_content);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultDocument->thumbnail_url);
        $this->assertSame(160, $inlineQueryResultDocument->thumbnail_width);
        $this->assertSame(120, $inlineQueryResultDocument->thumbnail_height);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_document_minimal.json');
        $inlineQueryResultDocument = InlineQueryResultDocument::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultDocument::class, $inlineQueryResultDocument);
        $this->assertNull($inlineQueryResultDocument->caption);
        $this->assertNull($inlineQueryResultDocument->parse_mode);
        $this->assertNull($inlineQueryResultDocument->caption_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_document_minimal.json');
        $inlineQueryResultDocument = InlineQueryResultDocument::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'document'], $inlineQueryResultDocument->toArray());
    }
}
