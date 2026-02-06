<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatBoostSource;
use F4\Pechkin\DataType\ChatBoostSourcePremium;
use F4\Pechkin\DataType\ChatBoostSourceGiftCode;
use F4\Pechkin\DataType\ChatBoostSourceGiveaway;

final class ChatBoostSourceTest extends TestCase
{
    private array $sampleUser = [
        'id' => '123456789',
        'is_bot' => false,
        'first_name' => 'John',
    ];

    public function testFromArrayWithPremiumType(): void
    {
        $data = [
            'type' => 'premium',
            'user' => $this->sampleUser,
        ];
        $result = ChatBoostSource::fromArray($data);
        $this->assertInstanceOf(ChatBoostSourcePremium::class, $result);
        $this->assertSame('123456789', $result->user->id);
        $this->assertFalse($result->user->is_bot);
        $this->assertSame('John', $result->user->first_name);
    }

    public function testFromArrayWithGiftCodeType(): void
    {
        $data = [
            'type' => 'gift_code',
            'user' => $this->sampleUser,
        ];
        $result = ChatBoostSource::fromArray($data);
        $this->assertInstanceOf(ChatBoostSourceGiftCode::class, $result);
        $this->assertSame('123456789', $result->user->id);
    }

    public function testFromArrayWithGiveawayType(): void
    {
        $data = [
            'type' => 'giveaway',
            'giveaway_message_id' => 42,
            'user' => $this->sampleUser,
            'is_unclaimed' => false,
        ];
        $result = ChatBoostSource::fromArray($data);
        $this->assertInstanceOf(ChatBoostSourceGiveaway::class, $result);
        $this->assertSame(42, $result->giveaway_message_id);
        $this->assertSame('123456789', $result->user->id);
        $this->assertFalse($result->is_unclaimed);
    }

    public function testFromArrayWithGiveawayTypeMinimal(): void
    {
        $data = [
            'type' => 'giveaway',
            'giveaway_message_id' => 42,
        ];
        $result = ChatBoostSource::fromArray($data);
        $this->assertInstanceOf(ChatBoostSourceGiveaway::class, $result);
        $this->assertSame(42, $result->giveaway_message_id);
        $this->assertNull($result->user);
        $this->assertNull($result->is_unclaimed);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'type' => 'giveaway',
            'giveaway_message_id' => 42,
            'user' => $this->sampleUser,
            'is_unclaimed' => false,
        ];
        $result = ChatBoostSource::fromArray($data);
        $this->assertSame($data, $result->toArray());
    }
}
