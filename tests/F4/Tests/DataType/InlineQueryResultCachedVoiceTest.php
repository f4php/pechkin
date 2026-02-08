<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultCachedVoice;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultCachedVoiceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_voice_full.json');
        $inlineQueryResultCachedVoice = InlineQueryResultCachedVoice::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedVoice::class, $inlineQueryResultCachedVoice);
        $this->assertNotEmpty($inlineQueryResultCachedVoice->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultCachedVoice->reply_markup);
        $this->assertNotNull($inlineQueryResultCachedVoice->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultCachedVoice->id);
        $this->assertSame('test_string', $inlineQueryResultCachedVoice->voice_file_id);
        $this->assertSame('Test Title', $inlineQueryResultCachedVoice->title);
        $this->assertSame('Test caption', $inlineQueryResultCachedVoice->caption);
        $this->assertSame('HTML', $inlineQueryResultCachedVoice->parse_mode);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultCachedVoice->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_voice_minimal.json');
        $inlineQueryResultCachedVoice = InlineQueryResultCachedVoice::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedVoice::class, $inlineQueryResultCachedVoice);
        $this->assertNull($inlineQueryResultCachedVoice->caption);
        $this->assertNull($inlineQueryResultCachedVoice->parse_mode);
        $this->assertNull($inlineQueryResultCachedVoice->caption_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_voice_minimal.json');
        $inlineQueryResultCachedVoice = InlineQueryResultCachedVoice::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'voice'], $inlineQueryResultCachedVoice->toArray());
    }
}
