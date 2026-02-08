<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\File;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class FileTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('file_full.json');
        $file = File::fromArray($data);

        $this->assertInstanceOf(File::class, $file);
        $this->assertSame('BAACAgIAAxkBAAI', $file->file_id);
        $this->assertSame('AgADBAADZqc', $file->file_unique_id);
        $this->assertSame('1024000', $file->file_size);
        $this->assertSame('/path/to/file', $file->file_path);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('file_minimal.json');
        $file = File::fromArray($data);

        $this->assertInstanceOf(File::class, $file);
        $this->assertNull($file->file_size);
        $this->assertNull($file->file_path);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('file_minimal.json');
        $file = File::fromArray($data);
        $this->assertEquals($data, $file->toArray());
    }
}
