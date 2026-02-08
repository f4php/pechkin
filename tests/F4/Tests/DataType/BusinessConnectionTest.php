<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BusinessBotRights;
use F4\Pechkin\DataType\BusinessConnection;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BusinessConnectionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('business_connection_full.json');
        $businessConnection = BusinessConnection::fromArray($data);

        $this->assertInstanceOf(BusinessConnection::class, $businessConnection);
        $this->assertInstanceOf(User::class, $businessConnection->user);
        $this->assertInstanceOf(BusinessBotRights::class, $businessConnection->rights);
        $this->assertSame('123456789', $businessConnection->id);
        $this->assertSame('123456789', $businessConnection->user_chat_id);
        $this->assertSame(1700000000, $businessConnection->date);
        $this->assertSame(true, $businessConnection->is_enabled);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('business_connection_minimal.json');
        $businessConnection = BusinessConnection::fromArray($data);

        $this->assertInstanceOf(BusinessConnection::class, $businessConnection);
        $this->assertNull($businessConnection->rights);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('business_connection_minimal.json');
        $businessConnection = BusinessConnection::fromArray($data);
        $this->assertEquals($data, $businessConnection->toArray());
    }
}
