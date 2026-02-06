<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatBoostSourceGiveaway;
use F4\Pechkin\DataType\User;

final class ChatBoostSourceGiveawayTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'giveaway_message_id' => 42,
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
            'prize_star_count' => 2,
            'is_unclaimed' => false,
        ];
        $source = ChatBoostSourceGiveaway::fromArray($data);

        $this->assertSame(42, $source->giveaway_message_id);
        $this->assertInstanceOf(User::class, $source->user);
        $this->assertSame(2, $source->prize_star_count);
        $this->assertFalse($source->is_unclaimed);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'giveaway_message_id' => 100,
        ];
        $source = ChatBoostSourceGiveaway::fromArray($data);

        $this->assertSame(100, $source->giveaway_message_id);
        $this->assertNull($source->user);
        $this->assertNull($source->is_unclaimed);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'giveaway_message_id' => 42,
            'user' => null,
            'is_unclaimed' => true,
        ];
        $source = ChatBoostSourceGiveaway::fromArray($data);
        $this->assertSame($data, $source->toArray());
    }
}
