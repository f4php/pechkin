<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputContactMessageContent;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputContactMessageContentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_contact_message_content_full.json');
        $inputContactMessageContent = InputContactMessageContent::fromArray($data);

        $this->assertInstanceOf(InputContactMessageContent::class, $inputContactMessageContent);
        $this->assertSame('+1234567890', $inputContactMessageContent->phone_number);
        $this->assertSame('John', $inputContactMessageContent->first_name);
        $this->assertSame('Doe', $inputContactMessageContent->last_name);
        $this->assertSame('BEGIN:VCARD\\nVERSION:3.0\\nFN:John Doe\\nEND:VCARD', $inputContactMessageContent->vcard);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_contact_message_content_minimal.json');
        $inputContactMessageContent = InputContactMessageContent::fromArray($data);

        $this->assertInstanceOf(InputContactMessageContent::class, $inputContactMessageContent);
        $this->assertNull($inputContactMessageContent->last_name);
        $this->assertNull($inputContactMessageContent->vcard);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_contact_message_content_minimal.json');
        $inputContactMessageContent = InputContactMessageContent::fromArray($data);
        $this->assertEquals($data, $inputContactMessageContent->toArray());
    }
}
