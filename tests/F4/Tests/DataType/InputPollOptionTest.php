<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputPollOption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputPollOptionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_poll_option_full.json');
        $inputPollOption = InputPollOption::fromArray($data);

        $this->assertInstanceOf(InputPollOption::class, $inputPollOption);
        $this->assertNotEmpty($inputPollOption->text_entities);
        $this->assertSame('Hello, World!', $inputPollOption->text);
        $this->assertSame('HTML', $inputPollOption->text_parse_mode);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_poll_option_minimal.json');
        $inputPollOption = InputPollOption::fromArray($data);

        $this->assertInstanceOf(InputPollOption::class, $inputPollOption);
        $this->assertNull($inputPollOption->text_parse_mode);
        $this->assertNull($inputPollOption->text_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_poll_option_minimal.json');
        $inputPollOption = InputPollOption::fromArray($data);
        $this->assertEquals($data, $inputPollOption->toArray());
    }
}
