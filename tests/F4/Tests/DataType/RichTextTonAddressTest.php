<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextTonAddress;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextTonAddressTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_ton_address_full.json');
        $obj = RichTextTonAddress::fromArray($data);

        $this->assertInstanceOf(RichTextTonAddress::class, $obj);
        $this->assertSame('ton_address', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('UQBvW8Z5huBkMJYdnfAEM5JqTNkuWX3diqYENkWsIL0XggGG', $obj->address);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_ton_address_full.json');
        $obj = RichTextTonAddress::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'ton_address'], $obj->toArray());
    }
}
