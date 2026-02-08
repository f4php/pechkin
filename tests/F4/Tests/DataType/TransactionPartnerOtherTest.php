<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TransactionPartnerOther;
use PHPUnit\Framework\TestCase;

final class TransactionPartnerOtherTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $transactionPartnerOther = TransactionPartnerOther::fromArray($data);
        $this->assertInstanceOf(TransactionPartnerOther::class, $transactionPartnerOther);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $transactionPartnerOther = TransactionPartnerOther::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'other'], $transactionPartnerOther->toArray());
    }
}
