<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotCommand;

final class BotCommandTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'command' => 'start',
            'description' => 'Start the bot',
        ];
        $command = BotCommand::fromArray($data);

        $this->assertSame('start', $command->command);
        $this->assertSame('Start the bot', $command->description);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'command' => 'settings',
            'description' => 'Open settings menu',
        ];
        $command = BotCommand::fromArray($data);

        $this->assertSame($data, $command->toArray());
    }
}
