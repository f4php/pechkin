<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\StarTransaction;
use F4\Pechkin\DataType\TransactionPartner;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StarTransactionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('star_transaction_full.json');
        $starTransaction = StarTransaction::fromArray($data);

        $this->assertInstanceOf(StarTransaction::class, $starTransaction);
        $this->assertNotNull($starTransaction->source);
        $this->assertNotNull($starTransaction->receiver);
        $this->assertSame('123456789', $starTransaction->id);
        $this->assertSame(1000, $starTransaction->amount);
        $this->assertSame(1700000000, $starTransaction->date);
        $this->assertSame(500, $starTransaction->nanostar_amount);
        $this->assertInstanceOf(TransactionPartner::class, $starTransaction->source);
        $this->assertInstanceOf(TransactionPartner::class, $starTransaction->receiver);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('star_transaction_minimal.json');
        $starTransaction = StarTransaction::fromArray($data);

        $this->assertInstanceOf(StarTransaction::class, $starTransaction);
        $this->assertNull($starTransaction->nanostar_amount);
        $this->assertNull($starTransaction->source);
        $this->assertNull($starTransaction->receiver);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('star_transaction_minimal.json');
        $starTransaction = StarTransaction::fromArray($data);
        $this->assertEquals($data, $starTransaction->toArray());
    }
}
