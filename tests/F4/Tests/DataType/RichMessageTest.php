<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlock;
use F4\Pechkin\DataType\RichBlockDivider;
use F4\Pechkin\DataType\RichBlockParagraph;
use F4\Pechkin\DataType\RichMessage;
use F4\Pechkin\DataType\RichTextBold;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichMessageTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_message_full.json');
        $message = RichMessage::fromArray($data);

        $this->assertInstanceOf(RichMessage::class, $message);
        $this->assertNotEmpty($message->blocks);
        $this->assertInstanceOf(RichBlock::class, $message->blocks[0]);
        $this->assertInstanceOf(RichBlockParagraph::class, $message->blocks[0]);
        $this->assertInstanceOf(RichBlockDivider::class, $message->blocks[1]);
        $this->assertSame(true, $message->is_rtl);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_message_minimal.json');
        $message = RichMessage::fromArray($data);

        $this->assertInstanceOf(RichMessage::class, $message);
        $this->assertNull($message->is_rtl);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_message_minimal.json');
        $message = RichMessage::fromArray($data);
        $this->assertEquals($data, $message->toArray());
    }

    /**
     * Captured live sendRichMessage response: RichText fields arrive as the
     * documented union — plain strings, arrays mixing RichText objects with
     * plain strings, or RichText objects.
     */
    public function testFromArrayWithServerPayload(): void
    {
        $data = $this->loadFixture('rich_message_server.json');
        $message = RichMessage::fromArray($data);

        $this->assertInstanceOf(RichMessage::class, $message);
        $paragraph = $message->blocks[0];
        $this->assertInstanceOf(RichBlockParagraph::class, $paragraph);
        $this->assertIsArray($paragraph->text);
        $this->assertInstanceOf(RichTextBold::class, $paragraph->text[0]);
        $this->assertSame('[integration] payload capture', $paragraph->text[0]->text);
        $this->assertSame(' plain tail', $paragraph->text[1]);

        $this->assertEquals($data, $message->toArray());
    }
}
