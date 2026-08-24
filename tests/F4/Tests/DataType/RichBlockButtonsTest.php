<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockButtons;
use F4\Pechkin\DataType\RichMessageButton;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockButtonsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_buttons_full.json');
        $obj = RichBlockButtons::fromArray($data);

        $this->assertInstanceOf(RichBlockButtons::class, $obj);
        $this->assertSame('buttons', $obj->type);
        $this->assertNotEmpty($obj->buttons);
        $this->assertInstanceOf(RichMessageButton::class, $obj->buttons[0]);
        $this->assertSame('center', $obj->align);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_buttons_minimal.json');
        $obj = RichBlockButtons::fromArray($data);

        $this->assertInstanceOf(RichBlockButtons::class, $obj);
        $this->assertNull($obj->align);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_buttons_full.json');
        $obj = RichBlockButtons::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'buttons'], $obj->toArray());
    }
}
