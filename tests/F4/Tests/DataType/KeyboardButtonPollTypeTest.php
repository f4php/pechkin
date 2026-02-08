<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\KeyboardButtonPollType;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class KeyboardButtonPollTypeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('keyboard_button_poll_type_full.json');
        $keyboardButtonPollType = KeyboardButtonPollType::fromArray($data);

        $this->assertInstanceOf(KeyboardButtonPollType::class, $keyboardButtonPollType);
        $this->assertSame('private', $keyboardButtonPollType->type);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('keyboard_button_poll_type_minimal.json');
        $keyboardButtonPollType = KeyboardButtonPollType::fromArray($data);

        $this->assertInstanceOf(KeyboardButtonPollType::class, $keyboardButtonPollType);
        $this->assertNull($keyboardButtonPollType->type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('keyboard_button_poll_type_minimal.json');
        $keyboardButtonPollType = KeyboardButtonPollType::fromArray($data);
        $this->assertEquals($data, $keyboardButtonPollType->toArray());
    }
}
