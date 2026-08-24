<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichMessageButton;
use F4\Pechkin\DataType\RichTextButton;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_button_full.json');
        $obj = RichTextButton::fromArray($data);

        $this->assertInstanceOf(RichTextButton::class, $obj);
        $this->assertSame('button', $obj->type);
        $this->assertInstanceOf(RichMessageButton::class, $obj->button);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_button_full.json');
        $obj = RichTextButton::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'button'], $obj->toArray());
    }
}
