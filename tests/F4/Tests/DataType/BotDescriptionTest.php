<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotDescription;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotDescriptionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_description_full.json');
        $botDescription = BotDescription::fromArray($data);

        $this->assertInstanceOf(BotDescription::class, $botDescription);
        $this->assertSame('Test description', $botDescription->description);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_description_minimal.json');
        $botDescription = BotDescription::fromArray($data);
        $this->assertEquals($data, $botDescription->toArray());
    }
}
