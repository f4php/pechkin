<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ManagedBotUpdated;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ManagedBotUpdatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('managed_bot_updated_full.json');
        $mbu = ManagedBotUpdated::fromArray($data);

        $this->assertInstanceOf(ManagedBotUpdated::class, $mbu);
        $this->assertInstanceOf(User::class, $mbu->user);
        $this->assertInstanceOf(User::class, $mbu->bot);
        $this->assertSame('123456789', $mbu->user->id);
        $this->assertSame('987654321', $mbu->bot->id);
        $this->assertTrue($mbu->bot->is_bot);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('managed_bot_updated_minimal.json');
        $mbu = ManagedBotUpdated::fromArray($data);
        $this->assertEquals($data, $mbu->toArray());
    }
}
