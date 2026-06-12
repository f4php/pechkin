<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichMessage;
use F4\Pechkin\DataType\InputRichMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_message_content_full.json');
        $content = InputRichMessageContent::fromArray($data);

        $this->assertInstanceOf(InputRichMessageContent::class, $content);
        $this->assertInstanceOf(InputRichMessage::class, $content->rich_message);
        $this->assertSame('<b>Hello</b>', $content->rich_message->html);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_message_content_full.json');
        $content = InputRichMessageContent::fromArray($data);
        $this->assertEquals($data, $content->toArray());
    }
}
