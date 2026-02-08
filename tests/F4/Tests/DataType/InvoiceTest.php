<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Invoice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InvoiceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('invoice_full.json');
        $invoice = Invoice::fromArray($data);

        $this->assertInstanceOf(Invoice::class, $invoice);
        $this->assertSame('Test Title', $invoice->title);
        $this->assertSame('Test description', $invoice->description);
        $this->assertSame('test_start', $invoice->start_parameter);
        $this->assertSame('USD', $invoice->currency);
        $this->assertSame(10000, $invoice->total_amount);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('invoice_minimal.json');
        $invoice = Invoice::fromArray($data);
        $this->assertEquals($data, $invoice->toArray());
    }
}
