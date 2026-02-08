<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputTextMessageContent;
use F4\Pechkin\DataType\LinkPreviewOptions;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputTextMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_text_message_content_full.json');
        $inputTextMessageContent = InputTextMessageContent::fromArray($data);

        $this->assertInstanceOf(InputTextMessageContent::class, $inputTextMessageContent);
        $this->assertNotEmpty($inputTextMessageContent->entities);
        $this->assertInstanceOf(LinkPreviewOptions::class, $inputTextMessageContent->link_preview_options);
        $this->assertSame('test_string', $inputTextMessageContent->message_text);
        $this->assertSame('HTML', $inputTextMessageContent->parse_mode);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_text_message_content_minimal.json');
        $inputTextMessageContent = InputTextMessageContent::fromArray($data);

        $this->assertInstanceOf(InputTextMessageContent::class, $inputTextMessageContent);
        $this->assertNull($inputTextMessageContent->parse_mode);
        $this->assertNull($inputTextMessageContent->entities);
        $this->assertNull($inputTextMessageContent->link_preview_options);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_text_message_content_minimal.json');
        $inputTextMessageContent = InputTextMessageContent::fromArray($data);
        $this->assertEquals($data, $inputTextMessageContent->toArray());
    }
}
