<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChatBoostRemoved;
use F4\Pechkin\DataType\ChatBoostSource;

final class ChatBoostRemovedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'chat' => ['id' => '123', 'type' => 'supergroup'],
            'boost_id' => 'boost_abc123',
            'remove_date' => 1700000000,
            'source' => [
                'type' => 'premium',
                'user' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Booster'],
            ],
        ];
        $removed = ChatBoostRemoved::fromArray($data);
        $this->assertInstanceOf(Chat::class, $removed->chat);
        $this->assertSame('boost_abc123', $removed->boost_id);
        $this->assertSame(1700000000, $removed->remove_date);
        $this->assertInstanceOf(ChatBoostSource::class, $removed->source);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'chat' => ['id' => '222', 'type' => 'supergroup'],
            'boost_id' => 'boost_ghi789',
            'remove_date' => 1700000000,
            'source' => [
                'type' => 'premium',
                'user' => ['id' => '333', 'is_bot' => false, 'first_name' => 'Premium'],
            ],
        ];
        $removed = ChatBoostRemoved::fromArray($data);
        $this->assertSame($data, $removed->toArray());
    }
}
