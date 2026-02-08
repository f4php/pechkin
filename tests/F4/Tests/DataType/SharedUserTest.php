<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\SharedUser;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SharedUserTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('shared_user_full.json');
        $sharedUser = SharedUser::fromArray($data);

        $this->assertInstanceOf(SharedUser::class, $sharedUser);
        $this->assertNotEmpty($sharedUser->photo);
        $this->assertSame('987654321', $sharedUser->user_id);
        $this->assertSame('John', $sharedUser->first_name);
        $this->assertSame('Doe', $sharedUser->last_name);
        $this->assertSame('johndoe', $sharedUser->username);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('shared_user_minimal.json');
        $sharedUser = SharedUser::fromArray($data);

        $this->assertInstanceOf(SharedUser::class, $sharedUser);
        $this->assertNull($sharedUser->first_name);
        $this->assertNull($sharedUser->last_name);
        $this->assertNull($sharedUser->username);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('shared_user_minimal.json');
        $sharedUser = SharedUser::fromArray($data);
        $this->assertEquals($data, $sharedUser->toArray());
    }
}
