<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputWidgetMessageContent;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Pechkin\DataType\MessageEntity;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputWidgetMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_widget_message_content_full.json');
        $inputWidgetMessageContent = InputWidgetMessageContent::fromArray($data);

        $this->assertInstanceOf(InputWidgetMessageContent::class, $inputWidgetMessageContent);
        $this->assertInstanceOf(InputMessageContent::class, $inputWidgetMessageContent);
        $this->assertSame('<div>Hello</div>', $inputWidgetMessageContent->html);
        $this->assertSame(300, $inputWidgetMessageContent->width);
        $this->assertSame(200, $inputWidgetMessageContent->height);
        $this->assertSame('public', $inputWidgetMessageContent->public_data);
        $this->assertSame('chat', $inputWidgetMessageContent->chat_data);
        $this->assertSame('Widget caption', $inputWidgetMessageContent->caption);
        $this->assertSame('HTML', $inputWidgetMessageContent->parse_mode);
        $this->assertContainsOnlyInstancesOf(MessageEntity::class, $inputWidgetMessageContent->caption_entities);
        $this->assertTrue($inputWidgetMessageContent->show_caption_above_media);
        $this->assertTrue($inputWidgetMessageContent->allow_queries);
        $this->assertFalse($inputWidgetMessageContent->is_shared);
        $this->assertInstanceOf(InputWidgetMessageContent::class, InputMessageContent::fromArray($data));
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_widget_message_content_minimal.json');
        $inputWidgetMessageContent = InputWidgetMessageContent::fromArray($data);

        $this->assertInstanceOf(InputWidgetMessageContent::class, $inputWidgetMessageContent);
        $this->assertSame('<div>Hello</div>', $inputWidgetMessageContent->html);
        $this->assertNull($inputWidgetMessageContent->width);
        $this->assertNull($inputWidgetMessageContent->height);
        $this->assertNull($inputWidgetMessageContent->public_data);
        $this->assertNull($inputWidgetMessageContent->chat_data);
        $this->assertNull($inputWidgetMessageContent->caption);
        $this->assertNull($inputWidgetMessageContent->parse_mode);
        $this->assertNull($inputWidgetMessageContent->caption_entities);
        $this->assertNull($inputWidgetMessageContent->show_caption_above_media);
        $this->assertNull($inputWidgetMessageContent->allow_queries);
        $this->assertNull($inputWidgetMessageContent->is_shared);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_widget_message_content_minimal.json');
        $inputWidgetMessageContent = InputWidgetMessageContent::fromArray($data);
        $this->assertEquals($data, $inputWidgetMessageContent->toArray());
    }
}
