<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UsersShared;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UsersSharedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('users_shared_full.json');
        $usersShared = UsersShared::fromArray($data);

        $this->assertInstanceOf(UsersShared::class, $usersShared);
        $this->assertNotEmpty($usersShared->users);
        $this->assertSame(12345, $usersShared->request_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('users_shared_minimal.json');
        $usersShared = UsersShared::fromArray($data);
        $this->assertEquals($data, $usersShared->toArray());
    }
}
