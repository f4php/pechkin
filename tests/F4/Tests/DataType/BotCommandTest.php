<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotCommand;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotCommandTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_command_full.json');
        $botCommand = BotCommand::fromArray($data);

        $this->assertInstanceOf(BotCommand::class, $botCommand);
        $this->assertSame('/start', $botCommand->command);
        $this->assertSame('Test description', $botCommand->description);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_command_minimal.json');
        $botCommand = BotCommand::fromArray($data);
        $this->assertEquals($data, $botCommand->toArray());
    }
}
