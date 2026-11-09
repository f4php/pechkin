<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\WidgetQueryWallet;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WidgetQueryWalletTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('widget_query_wallet_full.json');
        $wallet = WidgetQueryWallet::fromArray($data);

        $this->assertInstanceOf(WidgetQueryWallet::class, $wallet);
        $this->assertSame('UQBvW8Z5huBkMJYdnfAEM5JqTNkuWX3diqYENkWsIL0XggGG', $wallet->address);
        $this->assertSame('1500000000', $wallet->amount);
        $this->assertSame('a1b2c3d4e5f6', $wallet->public_key);
        $this->assertSame('te6ccgEBAgEAKAAA', $wallet->state_init);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('widget_query_wallet_minimal.json');
        $wallet = WidgetQueryWallet::fromArray($data);

        $this->assertInstanceOf(WidgetQueryWallet::class, $wallet);
        $this->assertNull($wallet->public_key);
        $this->assertNull($wallet->state_init);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('widget_query_wallet_minimal.json');
        $wallet = WidgetQueryWallet::fromArray($data);
        $this->assertEquals($data, $wallet->toArray());
    }
}
