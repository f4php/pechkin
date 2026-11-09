<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputSharedWidgetMessageContent;
use F4\Pechkin\DataType\InputMessageContent;
use F4\Pechkin\DataType\MessageEntity;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputSharedWidgetMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_shared_widget_message_content_full.json');
        $inputSharedWidgetMessageContent = InputSharedWidgetMessageContent::fromArray($data);

        $this->assertInstanceOf(InputSharedWidgetMessageContent::class, $inputSharedWidgetMessageContent);
        $this->assertInstanceOf(InputMessageContent::class, $inputSharedWidgetMessageContent);
        $this->assertSame('widget_123', $inputSharedWidgetMessageContent->widget_id);
        $this->assertSame('chat', $inputSharedWidgetMessageContent->chat_data);
        $this->assertSame('Widget caption', $inputSharedWidgetMessageContent->caption);
        $this->assertSame('HTML', $inputSharedWidgetMessageContent->parse_mode);
        $this->assertContainsOnlyInstancesOf(MessageEntity::class, $inputSharedWidgetMessageContent->caption_entities);
        $this->assertTrue($inputSharedWidgetMessageContent->show_caption_above_media);
        $this->assertInstanceOf(InputSharedWidgetMessageContent::class, InputMessageContent::fromArray($data));
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_shared_widget_message_content_minimal.json');
        $inputSharedWidgetMessageContent = InputSharedWidgetMessageContent::fromArray($data);

        $this->assertInstanceOf(InputSharedWidgetMessageContent::class, $inputSharedWidgetMessageContent);
        $this->assertSame('widget_123', $inputSharedWidgetMessageContent->widget_id);
        $this->assertNull($inputSharedWidgetMessageContent->chat_data);
        $this->assertNull($inputSharedWidgetMessageContent->caption);
        $this->assertNull($inputSharedWidgetMessageContent->parse_mode);
        $this->assertNull($inputSharedWidgetMessageContent->caption_entities);
        $this->assertNull($inputSharedWidgetMessageContent->show_caption_above_media);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_shared_widget_message_content_minimal.json');
        $inputSharedWidgetMessageContent = InputSharedWidgetMessageContent::fromArray($data);
        $this->assertEquals($data, $inputSharedWidgetMessageContent->toArray());
    }
}
