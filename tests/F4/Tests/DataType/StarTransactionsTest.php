<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\StarTransactions;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class StarTransactionsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('star_transactions_full.json');
        $starTransactions = StarTransactions::fromArray($data);

        $this->assertInstanceOf(StarTransactions::class, $starTransactions);
        $this->assertNotEmpty($starTransactions->transactions);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('star_transactions_minimal.json');
        $starTransactions = StarTransactions::fromArray($data);
        $this->assertEquals($data, $starTransactions->toArray());
    }
}
