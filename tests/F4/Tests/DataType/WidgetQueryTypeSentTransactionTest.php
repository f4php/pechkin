<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\WidgetQueryTypeSentTransaction;
use F4\Pechkin\DataType\WidgetQueryWallet;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WidgetQueryTypeSentTransactionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('widget_query_type_sent_transaction_full.json');
        $queryType = WidgetQueryTypeSentTransaction::fromArray($data);

        $this->assertInstanceOf(WidgetQueryTypeSentTransaction::class, $queryType);
        $this->assertSame('sent_transaction', $queryType->type);
        $this->assertInstanceOf(WidgetQueryWallet::class, $queryType->wallet);
        $this->assertSame('a1b2c3d4e5f6', $queryType->wallet->public_key);
        $this->assertSame('hash123', $queryType->msg_hash);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('widget_query_type_sent_transaction_minimal.json');
        $queryType = WidgetQueryTypeSentTransaction::fromArray($data);

        $this->assertInstanceOf(WidgetQueryTypeSentTransaction::class, $queryType);
        $this->assertNull($queryType->wallet->public_key);
        $this->assertNull($queryType->wallet->state_init);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('widget_query_type_sent_transaction_minimal.json');
        $queryType = WidgetQueryTypeSentTransaction::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'sent_transaction'], $queryType->toArray());
    }
}
