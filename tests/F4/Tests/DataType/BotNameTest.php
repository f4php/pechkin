<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotName;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotNameTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_name_full.json');
        $botName = BotName::fromArray($data);

        $this->assertInstanceOf(BotName::class, $botName);
        $this->assertSame('Test Name', $botName->name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_name_minimal.json');
        $botName = BotName::fromArray($data);
        $this->assertEquals($data, $botName->toArray());
    }
}
