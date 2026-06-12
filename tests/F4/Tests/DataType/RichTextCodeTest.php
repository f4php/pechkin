<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextCode;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextCodeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_code_full.json');
        $obj = RichTextCode::fromArray($data);

        $this->assertInstanceOf(RichTextCode::class, $obj);
        $this->assertSame('code', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_code_full.json');
        $obj = RichTextCode::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'code'], $obj->toArray());
    }
}
