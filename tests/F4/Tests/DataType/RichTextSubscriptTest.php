<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextSubscript;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextSubscriptTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_subscript_full.json');
        $obj = RichTextSubscript::fromArray($data);

        $this->assertInstanceOf(RichTextSubscript::class, $obj);
        $this->assertSame('subscript', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_subscript_full.json');
        $obj = RichTextSubscript::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'subscript'], $obj->toArray());
    }
}
