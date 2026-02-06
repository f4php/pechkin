<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatMemberLeft;
use F4\Pechkin\DataType\User;

final class ChatMemberLeftTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
        ];
        $member = ChatMemberLeft::fromArray($data);

        $this->assertInstanceOf(User::class, $member->user);
        $this->assertSame('123456789', $member->user->id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
        ];
        $member = ChatMemberLeft::fromArray($data);
        $this->assertSame($data, $member->toArray());
    }
}
