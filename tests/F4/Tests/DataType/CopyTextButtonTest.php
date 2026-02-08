<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\CopyTextButton;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class CopyTextButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('copy_text_button_full.json');
        $copyTextButton = CopyTextButton::fromArray($data);

        $this->assertInstanceOf(CopyTextButton::class, $copyTextButton);
        $this->assertSame('Hello, World!', $copyTextButton->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('copy_text_button_minimal.json');
        $copyTextButton = CopyTextButton::fromArray($data);
        $this->assertEquals($data, $copyTextButton->toArray());
    }
}
