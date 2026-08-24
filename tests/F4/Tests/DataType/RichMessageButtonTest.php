<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\DisabledButton;
use F4\Pechkin\DataType\LoginUrl;
use F4\Pechkin\DataType\RichMessageButton;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichMessageButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_message_button_full.json');
        $obj = RichMessageButton::fromArray($data);

        $this->assertInstanceOf(RichMessageButton::class, $obj);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('primary', $obj->style);
        $this->assertInstanceOf(LoginUrl::class, $obj->login_url);
        $this->assertInstanceOf(DisabledButton::class, $obj->disabled);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_message_button_minimal.json');
        $obj = RichMessageButton::fromArray($data);

        $this->assertInstanceOf(RichMessageButton::class, $obj);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertNull($obj->style);
        $this->assertNull($obj->disabled);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_message_button_minimal.json');
        $obj = RichMessageButton::fromArray($data);
        $this->assertEquals($data, $obj->toArray());
    }
}
