<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultVoice;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultVoiceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_voice_full.json');
        $inlineQueryResultVoice = InlineQueryResultVoice::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultVoice::class, $inlineQueryResultVoice);
        $this->assertNotEmpty($inlineQueryResultVoice->caption_entities);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultVoice->reply_markup);
        $this->assertNotNull($inlineQueryResultVoice->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultVoice->id);
        $this->assertSame('https://example.com/voice.ogg', $inlineQueryResultVoice->voice_url);
        $this->assertSame('Test Title', $inlineQueryResultVoice->title);
        $this->assertSame('Test caption', $inlineQueryResultVoice->caption);
        $this->assertSame('HTML', $inlineQueryResultVoice->parse_mode);
        $this->assertSame(30, $inlineQueryResultVoice->voice_duration);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultVoice->input_message_content);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_voice_minimal.json');
        $inlineQueryResultVoice = InlineQueryResultVoice::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultVoice::class, $inlineQueryResultVoice);
        $this->assertNull($inlineQueryResultVoice->caption);
        $this->assertNull($inlineQueryResultVoice->parse_mode);
        $this->assertNull($inlineQueryResultVoice->caption_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_voice_minimal.json');
        $inlineQueryResultVoice = InlineQueryResultVoice::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'voice'], $inlineQueryResultVoice->toArray());
    }
}
