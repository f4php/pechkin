<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TonWalletCardSticker;
use F4\Pechkin\DataType\AreaPosition;
use F4\Pechkin\DataType\TonNft;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TonWalletCardStickerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('ton_wallet_card_sticker_full.json');
        $tonWalletCardSticker = TonWalletCardSticker::fromArray($data);

        $this->assertInstanceOf(TonWalletCardSticker::class, $tonWalletCardSticker);
        $this->assertInstanceOf(AreaPosition::class, $tonWalletCardSticker->position);
        $this->assertSame(50.5, $tonWalletCardSticker->position->x_percentage);
        $this->assertInstanceOf(TonNft::class, $tonWalletCardSticker->nft);
        $this->assertNotNull($tonWalletCardSticker->nft->gift);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('ton_wallet_card_sticker_minimal.json');
        $tonWalletCardSticker = TonWalletCardSticker::fromArray($data);

        $this->assertInstanceOf(TonWalletCardSticker::class, $tonWalletCardSticker);
        $this->assertInstanceOf(AreaPosition::class, $tonWalletCardSticker->position);
        $this->assertInstanceOf(TonNft::class, $tonWalletCardSticker->nft);
        $this->assertNull($tonWalletCardSticker->nft->gift);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('ton_wallet_card_sticker_minimal.json');
        $tonWalletCardSticker = TonWalletCardSticker::fromArray($data);
        $this->assertEquals($data, $tonWalletCardSticker->toArray());
    }
}
