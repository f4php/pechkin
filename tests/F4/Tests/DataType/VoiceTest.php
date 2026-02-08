<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Voice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class VoiceTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('voice_full.json');
        $voice = Voice::fromArray($data);

        $this->assertInstanceOf(Voice::class, $voice);
        $this->assertSame('BAACAgIAAxkBAAI', $voice->file_id);
        $this->assertSame('AgADBAADZqc', $voice->file_unique_id);
        $this->assertSame(120, $voice->duration);
        $this->assertSame('application/pdf', $voice->mime_type);
        $this->assertSame('1024000', $voice->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('voice_minimal.json');
        $voice = Voice::fromArray($data);

        $this->assertInstanceOf(Voice::class, $voice);
        $this->assertNull($voice->mime_type);
        $this->assertNull($voice->file_size);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('voice_minimal.json');
        $voice = Voice::fromArray($data);
        $this->assertEquals($data, $voice->toArray());
    }
}
