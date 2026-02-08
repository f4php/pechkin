<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatBoostSource;
use F4\Pechkin\DataType\ChatBoostSourcePremium;
use F4\Pechkin\DataType\ChatBoostSourceGiftCode;
use F4\Pechkin\DataType\ChatBoostSourceGiveaway;

final class ChatBoostSourceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithPremiumType(): void
    {
        $data = [
            ...$this->loadFixture('chat_boost_source_premium_full.json'),
             'source' => 'premium',
        ];
        $result = ChatBoostSource::fromArray($data);
        $this->assertInstanceOf(ChatBoostSourcePremium::class, $result);
    }

    public function testFromArrayWithGiftCodeType(): void
    {
        $data = [
            ...$this->loadFixture('chat_boost_source_gift_code_full.json'),
            'source' => 'gift_code',
        ];
        $result = ChatBoostSource::fromArray($data);
        $this->assertInstanceOf(ChatBoostSourceGiftCode::class, $result);
    }

    public function testFromArrayWithGiveawayType(): void
    {
        $data = [
            ...$this->loadFixture('chat_boost_source_giveaway_full.json'),
            'source' => 'giveaway',
        ];
        $result = ChatBoostSource::fromArray($data);
        $this->assertInstanceOf(ChatBoostSourceGiveaway::class, $result);
    }

}
