<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatBoostUpdated;
use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatBoost;

final class ChatBoostUpdatedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'chat' => ['id' => '123', 'type' => 'supergroup'],
            'boost' => [
                'boost_id' => 'boost_abc',
                'add_date' => 1700000000,
                'expiration_date' => 1702592000,
                'source' => [
                    'type' => 'premium',
                    'user' => ['id' => '456', 'is_bot' => false, 'first_name' => 'User'],
                ],
            ],
        ];
        $updated = ChatBoostUpdated::fromArray($data);
        $this->assertInstanceOf(Chat::class, $updated->chat);
        $this->assertInstanceOf(ChatBoost::class, $updated->boost);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'chat' => ['id' => '222', 'type' => 'supergroup'],
            'boost' => [
                'boost_id' => 'boost_test',
                'add_date' => 1700000000,
                'expiration_date' => 1702592000,
                'source' => [
                    'type' => 'premium',
                    'user' => ['id' => '333', 'is_bot' => false, 'first_name' => 'Test'],
                ],
            ],
        ];
        $updated = ChatBoostUpdated::fromArray($data);
        $this->assertSame($data, $updated->toArray());
    }
}
