<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineKeyboardMarkup;
use F4\Pechkin\DataType\InlineQueryResultContact;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultContactTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_result_contact_full.json');
        $inlineQueryResultContact = InlineQueryResultContact::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultContact::class, $inlineQueryResultContact);
        $this->assertInstanceOf(InlineKeyboardMarkup::class, $inlineQueryResultContact->reply_markup);
        $this->assertNotNull($inlineQueryResultContact->input_message_content);
        $this->assertSame('123456789', $inlineQueryResultContact->id);
        $this->assertSame('+1234567890', $inlineQueryResultContact->phone_number);
        $this->assertSame('John', $inlineQueryResultContact->first_name);
        $this->assertSame('Doe', $inlineQueryResultContact->last_name);
        $this->assertSame('BEGIN:VCARD\\nVERSION:3.0\\nFN:John Doe\\nEND:VCARD', $inlineQueryResultContact->vcard);
        $this->assertInstanceOf(InputMessageContent::class, $inlineQueryResultContact->input_message_content);
        $this->assertSame('https://example.com/thumb.jpg', $inlineQueryResultContact->thumbnail_url);
        $this->assertSame(160, $inlineQueryResultContact->thumbnail_width);
        $this->assertSame(120, $inlineQueryResultContact->thumbnail_height);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_result_contact_minimal.json');
        $inlineQueryResultContact = InlineQueryResultContact::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultContact::class, $inlineQueryResultContact);
        $this->assertNull($inlineQueryResultContact->last_name);
        $this->assertNull($inlineQueryResultContact->vcard);
        $this->assertNull($inlineQueryResultContact->reply_markup);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_result_contact_minimal.json');
        $inlineQueryResultContact = InlineQueryResultContact::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'contact'], $inlineQueryResultContact->toArray());
    }
}
