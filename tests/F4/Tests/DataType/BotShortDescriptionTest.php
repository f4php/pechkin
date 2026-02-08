<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotShortDescription;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotShortDescriptionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_short_description_full.json');
        $botShortDescription = BotShortDescription::fromArray($data);

        $this->assertInstanceOf(BotShortDescription::class, $botShortDescription);
        $this->assertSame('test_string', $botShortDescription->short_description);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_short_description_minimal.json');
        $botShortDescription = BotShortDescription::fromArray($data);
        $this->assertEquals($data, $botShortDescription->toArray());
    }
}
