<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotAccessSettings;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotAccessSettingsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_access_settings_full.json');
        $settings = BotAccessSettings::fromArray($data);

        $this->assertInstanceOf(BotAccessSettings::class, $settings);
        $this->assertTrue($settings->is_access_restricted);
        $this->assertIsArray($settings->added_users);
        $this->assertCount(1, $settings->added_users);
        $this->assertInstanceOf(User::class, $settings->added_users[0]);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('bot_access_settings_minimal.json');
        $settings = BotAccessSettings::fromArray($data);

        $this->assertInstanceOf(BotAccessSettings::class, $settings);
        $this->assertFalse($settings->is_access_restricted);
        $this->assertNull($settings->added_users);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_access_settings_minimal.json');
        $settings = BotAccessSettings::fromArray($data);
        $this->assertEquals($data, $settings->toArray());
    }
}
