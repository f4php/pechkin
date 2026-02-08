<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TextQuote;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TextQuoteTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('text_quote_full.json');
        $textQuote = TextQuote::fromArray($data);

        $this->assertInstanceOf(TextQuote::class, $textQuote);
        $this->assertNotEmpty($textQuote->entities);
        $this->assertSame('Hello, World!', $textQuote->text);
        $this->assertSame(1, $textQuote->position);
        $this->assertSame(false, $textQuote->is_manual);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('text_quote_minimal.json');
        $textQuote = TextQuote::fromArray($data);

        $this->assertInstanceOf(TextQuote::class, $textQuote);
        $this->assertNull($textQuote->entities);
        $this->assertNull($textQuote->is_manual);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('text_quote_minimal.json');
        $textQuote = TextQuote::fromArray($data);
        $this->assertEquals($data, $textQuote->toArray());
    }
}
