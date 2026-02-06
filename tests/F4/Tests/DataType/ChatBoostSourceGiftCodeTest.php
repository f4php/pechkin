<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatBoostSourceGiftCode;
use F4\Pechkin\DataType\User;

final class ChatBoostSourceGiftCodeTest extends TestCase
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
        $source = ChatBoostSourceGiftCode::fromArray($data);

        $this->assertInstanceOf(User::class, $source->user);
        $this->assertSame('123456789', $source->user->id);
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
        $source = ChatBoostSourceGiftCode::fromArray($data);
        $this->assertSame($data, $source->toArray());
    }
}
