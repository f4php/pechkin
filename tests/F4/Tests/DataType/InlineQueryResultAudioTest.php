<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultAudio;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultAudioTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_audio_full.json');
        $inlineQueryResultAudio = InlineQueryResultAudio::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultAudio::class, $inlineQueryResultAudio);
        $this->assertNotEmpty($inlineQueryResultAudio->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultAudio->reply_markup);
        $this->assertNotNull($inlineQueryResultAudio->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultAudio->id);
        $this->assertSame('https://example.com/audio.mp3', $inlineQueryResultAudio->audio_url);
        $this->assertSame('Test Title', $inlineQueryResultAudio->title);
        $this->assertSame('Test caption', $inlineQueryResultAudio->caption);
        $this->assertSame('HTML', $inlineQueryResultAudio->parse_mode);
        $this->assertSame('Test Artist', $inlineQueryResultAudio->performer);
        $this->assertSame(180, $inlineQueryResultAudio->audio_duration);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultAudio->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_audio_minimal.json');
        $inlineQueryResultAudio = InlineQueryResultAudio::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultAudio::class, $inlineQueryResultAudio);
        $this->assertNull($inlineQueryResultAudio->caption);
        $this->assertNull($inlineQueryResultAudio->parse_mode);
        $this->assertNull($inlineQueryResultAudio->caption_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_audio_minimal.json');
        $inlineQueryResultAudio = InlineQueryResultAudio::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'audio'], $inlineQueryResultAudio->toArray());
    }
}
