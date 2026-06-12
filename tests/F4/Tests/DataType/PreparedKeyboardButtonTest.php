<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PreparedKeyboardButton;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PreparedKeyboardButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('prepared_keyboard_button_full.json');
        $pkb = PreparedKeyboardButton::fromArray($data);

        $this->assertInstanceOf(PreparedKeyboardButton::class, $pkb);
        $this->assertSame('42', $pkb->id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('prepared_keyboard_button_minimal.json');
        $pkb = PreparedKeyboardButton::fromArray($data);
        $this->assertEquals($data, $pkb->toArray());
    }
}
