<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BackgroundFill;
use F4\Pechkin\DataType\BackgroundTypePattern;
use F4\Pechkin\DataType\Document;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BackgroundTypePatternTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('background_type_pattern_full.json');
        $backgroundTypePattern = BackgroundTypePattern::fromArray($data);

        $this->assertInstanceOf(BackgroundTypePattern::class, $backgroundTypePattern);
        $this->assertInstanceOf(Document::class, $backgroundTypePattern->document);
        $this->assertNotNull($backgroundTypePattern->fill);
        $this->assertInstanceOf(BackgroundFill::class, $backgroundTypePattern->fill);
        $this->assertSame(80, $backgroundTypePattern->intensity);
        $this->assertSame(false, $backgroundTypePattern->is_inverted);
        $this->assertSame(false, $backgroundTypePattern->is_moving);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('background_type_pattern_minimal.json');
        $backgroundTypePattern = BackgroundTypePattern::fromArray($data);

        $this->assertInstanceOf(BackgroundTypePattern::class, $backgroundTypePattern);
        $this->assertNull($backgroundTypePattern->is_inverted);
        $this->assertNull($backgroundTypePattern->is_moving);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('background_type_pattern_minimal.json');
        $backgroundTypePattern = BackgroundTypePattern::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'pattern'], $backgroundTypePattern->toArray());
    }
}
