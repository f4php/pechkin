<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextPhoneNumber;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextPhoneNumberTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_phone_number_full.json');
        $obj = RichTextPhoneNumber::fromArray($data);

        $this->assertInstanceOf(RichTextPhoneNumber::class, $obj);
        $this->assertSame('phone_number', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('+15551234567', $obj->phone_number);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_phone_number_full.json');
        $obj = RichTextPhoneNumber::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'phone_number'], $obj->toArray());
    }
}
