<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextCashtag;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextCashtagTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_cashtag_full.json');
        $obj = RichTextCashtag::fromArray($data);

        $this->assertInstanceOf(RichTextCashtag::class, $obj);
        $this->assertSame('cashtag', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('USD', $obj->cashtag);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_cashtag_full.json');
        $obj = RichTextCashtag::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'cashtag'], $obj->toArray());
    }
}
