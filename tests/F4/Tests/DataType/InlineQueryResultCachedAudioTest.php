<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultCachedAudio;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultCachedAudioTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_audio_full.json');
        $inlineQueryResultCachedAudio = InlineQueryResultCachedAudio::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedAudio::class, $inlineQueryResultCachedAudio);
        $this->assertNotEmpty($inlineQueryResultCachedAudio->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultCachedAudio->reply_markup);
        $this->assertNotNull($inlineQueryResultCachedAudio->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultCachedAudio->id);
        $this->assertSame('test_string', $inlineQueryResultCachedAudio->audio_file_id);
        $this->assertSame('Test caption', $inlineQueryResultCachedAudio->caption);
        $this->assertSame('HTML', $inlineQueryResultCachedAudio->parse_mode);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultCachedAudio->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_audio_minimal.json');
        $inlineQueryResultCachedAudio = InlineQueryResultCachedAudio::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultCachedAudio::class, $inlineQueryResultCachedAudio);
        $this->assertNull($inlineQueryResultCachedAudio->caption);
        $this->assertNull($inlineQueryResultCachedAudio->parse_mode);
        $this->assertNull($inlineQueryResultCachedAudio->caption_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_cached_audio_minimal.json');
        $inlineQueryResultCachedAudio = InlineQueryResultCachedAudio::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'audio'], $inlineQueryResultCachedAudio->toArray());
    }
}
