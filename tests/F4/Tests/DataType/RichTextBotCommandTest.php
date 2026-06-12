<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextBotCommand;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextBotCommandTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_bot_command_full.json');
        $obj = RichTextBotCommand::fromArray($data);

        $this->assertInstanceOf(RichTextBotCommand::class, $obj);
        $this->assertSame('bot_command', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('/start', $obj->bot_command);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_bot_command_full.json');
        $obj = RichTextBotCommand::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'bot_command'], $obj->toArray());
    }
}
