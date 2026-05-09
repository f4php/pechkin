<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UserShared;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UserSharedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('user_shared_full.json');
        $us = UserShared::fromArray($data);

        $this->assertInstanceOf(UserShared::class, $us);
        $this->assertSame(3, $us->request_id);
        $this->assertSame('123456789', $us->user_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('user_shared_minimal.json');
        $us = UserShared::fromArray($data);
        $this->assertEquals($data, $us->toArray());
    }
}
