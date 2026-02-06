<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundTypePattern;
use F4\Pechkin\DataType\Document;
use F4\Pechkin\DataType\BackgroundFill;

final class BackgroundTypePatternTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'document' => ['file_id' => 'abc123', 'file_unique_id' => 'xyz789'],
            'fill' => ['type' => 'solid', 'color' => 16777215],
            'intensity' => 80,
            'is_inverted' => true,
            'is_moving' => true,
        ];
        $pattern = BackgroundTypePattern::fromArray($data);
        $this->assertInstanceOf(Document::class, $pattern->document);
        $this->assertInstanceOf(BackgroundFill::class, $pattern->fill);
        $this->assertSame(80, $pattern->intensity);
        $this->assertSame(true, $pattern->is_inverted);
        $this->assertSame(true, $pattern->is_moving);
    }

    public function testFromArrayCreatesCorrectStructureMinimalData(): void
    {
        $data = [
            'document' => ['file_id' => 'abc123', 'file_unique_id' => 'xyz789'],
            'fill' => ['type' => 'solid', 'color' => 16777215],
            'intensity' => 80,
        ];
        $pattern = BackgroundTypePattern::fromArray($data);
        $this->assertInstanceOf(Document::class, $pattern->document);
        $this->assertInstanceOf(BackgroundFill::class, $pattern->fill);
        $this->assertSame(80, $pattern->intensity);
        $this->assertNull($pattern->is_inverted);
        $this->assertNull($pattern->is_moving);
    }


    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'document' => ['file_id' => 'ghi789', 'file_unique_id' => 'rst456'],
            'fill' => ['type' => 'solid', 'color' => 128],
            'intensity' => 100,
        ];
        $pattern = BackgroundTypePattern::fromArray($data);
        unset($data['fill']['type']);
        $this->assertSame($data, $pattern->toArray());
    }
}
