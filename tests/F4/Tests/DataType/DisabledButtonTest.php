<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\DisabledButton;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class DisabledButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('disabled_button_full.json');
        $obj = DisabledButton::fromArray($data);

        $this->assertInstanceOf(DisabledButton::class, $obj);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('disabled_button_minimal.json');
        $obj = DisabledButton::fromArray($data);
        $this->assertEquals($data, $obj->toArray());
    }
}
