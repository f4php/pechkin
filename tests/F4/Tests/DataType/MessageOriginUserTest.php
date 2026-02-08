<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MessageOriginUser;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageOriginUserTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_origin_user_full.json');
        $messageOriginUser = MessageOriginUser::fromArray($data);

        $this->assertInstanceOf(MessageOriginUser::class, $messageOriginUser);
        $this->assertInstanceOf(User::class, $messageOriginUser->sender_user);
        $this->assertSame(1700000000, $messageOriginUser->date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_origin_user_minimal.json');
        $messageOriginUser = MessageOriginUser::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'user'], $messageOriginUser->toArray());
    }
}
