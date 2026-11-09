<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TonWalletTransfer;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TonWalletTransferTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('ton_wallet_transfer_full.json');
        $tonWalletTransfer = TonWalletTransfer::fromArray($data);

        $this->assertInstanceOf(TonWalletTransfer::class, $tonWalletTransfer);
        $this->assertSame('tx_abc123', $tonWalletTransfer->transaction_id);
        $this->assertSame('EQCpeer00000000000000000000000000000000000000001', $tonWalletTransfer->peer_address);
        $this->assertSame('-1500000000', $tonWalletTransfer->amount);
        $this->assertSame('Thanks!', $tonWalletTransfer->comment);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('ton_wallet_transfer_minimal.json');
        $tonWalletTransfer = TonWalletTransfer::fromArray($data);

        $this->assertInstanceOf(TonWalletTransfer::class, $tonWalletTransfer);
        $this->assertSame('', $tonWalletTransfer->transaction_id);
        $this->assertSame('1500000000', $tonWalletTransfer->amount);
        $this->assertNull($tonWalletTransfer->comment);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('ton_wallet_transfer_minimal.json');
        $tonWalletTransfer = TonWalletTransfer::fromArray($data);
        $this->assertEquals($data, $tonWalletTransfer->toArray());
    }
}
