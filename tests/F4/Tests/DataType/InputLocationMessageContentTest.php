<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputLocationMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputLocationMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_location_message_content_full.json');
        $inputLocationMessageContent = InputLocationMessageContent::fromArray($data);

        $this->assertInstanceOf(InputLocationMessageContent::class, $inputLocationMessageContent);
        $this->assertSame(55.7558, $inputLocationMessageContent->latitude);
        $this->assertSame(37.6173, $inputLocationMessageContent->longitude);
        $this->assertSame(10.5, $inputLocationMessageContent->horizontal_accuracy);
        $this->assertSame(3600, $inputLocationMessageContent->live_period);
        $this->assertSame(180, $inputLocationMessageContent->heading);
        $this->assertSame(100, $inputLocationMessageContent->proximity_alert_radius);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_location_message_content_minimal.json');
        $inputLocationMessageContent = InputLocationMessageContent::fromArray($data);

        $this->assertInstanceOf(InputLocationMessageContent::class, $inputLocationMessageContent);
        $this->assertNull($inputLocationMessageContent->horizontal_accuracy);
        $this->assertNull($inputLocationMessageContent->live_period);
        $this->assertNull($inputLocationMessageContent->heading);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_location_message_content_minimal.json');
        $inputLocationMessageContent = InputLocationMessageContent::fromArray($data);
        $this->assertEquals($data, $inputLocationMessageContent->toArray());
    }
}
