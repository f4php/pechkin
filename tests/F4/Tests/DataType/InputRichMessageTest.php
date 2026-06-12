<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichMessage;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichMessageTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_message_full.json');
        $message = InputRichMessage::fromArray($data);

        $this->assertInstanceOf(InputRichMessage::class, $message);
        $this->assertSame('<b>Hello</b>', $message->html);
        $this->assertSame('*Hello*', $message->markdown);
        $this->assertSame(false, $message->is_rtl);
        $this->assertSame(true, $message->skip_entity_detection);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_message_minimal.json');
        $message = InputRichMessage::fromArray($data);

        $this->assertInstanceOf(InputRichMessage::class, $message);
        $this->assertNull($message->html);
        $this->assertNull($message->markdown);
        $this->assertNull($message->is_rtl);
        $this->assertNull($message->skip_entity_detection);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_message_minimal.json');
        $message = InputRichMessage::fromArray($data);
        $this->assertEquals($data, $message->toArray());
    }
}
