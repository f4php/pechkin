<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TonWalletCard;
use F4\Pechkin\DataType\TonWalletCardSticker;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TonWalletCardTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('ton_wallet_card_full.json');
        $tonWalletCard = TonWalletCard::fromArray($data);

        $this->assertInstanceOf(TonWalletCard::class, $tonWalletCard);
        $this->assertSame('EQCwallet0000000000000000000000000000000000000001', $tonWalletCard->address);
        $this->assertSame('123456789012345678901', $tonWalletCard->amount);
        $this->assertCount(1, $tonWalletCard->stickers);
        $this->assertInstanceOf(TonWalletCardSticker::class, $tonWalletCard->stickers[0]);
        $this->assertSame('EQBnft0000000000000000000000000000000000000000001', $tonWalletCard->background_nft_address);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('ton_wallet_card_minimal.json');
        $tonWalletCard = TonWalletCard::fromArray($data);

        $this->assertInstanceOf(TonWalletCard::class, $tonWalletCard);
        $this->assertSame('0', $tonWalletCard->amount);
        $this->assertSame([], $tonWalletCard->stickers);
        $this->assertNull($tonWalletCard->background_nft_address);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('ton_wallet_card_minimal.json');
        $tonWalletCard = TonWalletCard::fromArray($data);
        $this->assertEquals($data, $tonWalletCard->toArray());
    }
}
