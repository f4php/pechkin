<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ManagedBotCreated;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ManagedBotCreatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('managed_bot_created_full.json');
        $mbc = ManagedBotCreated::fromArray($data);

        $this->assertInstanceOf(ManagedBotCreated::class, $mbc);
        $this->assertInstanceOf(User::class, $mbc->bot);
        $this->assertSame('987654321', $mbc->bot->id);
        $this->assertTrue($mbc->bot->is_bot);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('managed_bot_created_minimal.json');
        $mbc = ManagedBotCreated::fromArray($data);
        $this->assertEquals($data, $mbc->toArray());
    }
}
