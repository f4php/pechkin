<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockButtons;
use F4\Pechkin\DataType\RichMessageButton;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockButtonsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_buttons_full.json');
        $obj = InputRichBlockButtons::fromArray($data);

        $this->assertInstanceOf(InputRichBlockButtons::class, $obj);
        $this->assertSame('buttons', $obj->type);
        $this->assertNotEmpty($obj->buttons);
        $this->assertInstanceOf(RichMessageButton::class, $obj->buttons[0]);
        $this->assertSame('center', $obj->align);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_buttons_minimal.json');
        $obj = InputRichBlockButtons::fromArray($data);

        $this->assertInstanceOf(InputRichBlockButtons::class, $obj);
        $this->assertNull($obj->align);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_buttons_full.json');
        $obj = InputRichBlockButtons::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'buttons'], $obj->toArray());
    }
}
