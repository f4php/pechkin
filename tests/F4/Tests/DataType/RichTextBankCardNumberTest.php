<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextBankCardNumber;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextBankCardNumberTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_bank_card_number_full.json');
        $obj = RichTextBankCardNumber::fromArray($data);

        $this->assertInstanceOf(RichTextBankCardNumber::class, $obj);
        $this->assertSame('bank_card_number', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('4111111111111111', $obj->bank_card_number);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_bank_card_number_full.json');
        $obj = RichTextBankCardNumber::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'bank_card_number'], $obj->toArray());
    }
}
