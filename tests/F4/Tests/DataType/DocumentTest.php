<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Document;
use F4\Pechkin\DataType\PhotoSize;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class DocumentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('document_full.json');
        $document = Document::fromArray($data);

        $this->assertInstanceOf(Document::class, $document);
        $this->assertInstanceOf(PhotoSize::class, $document->thumbnail);
        $this->assertSame('BAACAgIAAxkBAAI', $document->file_id);
        $this->assertSame('AgADBAADZqc', $document->file_unique_id);
        $this->assertSame('test_file.pdf', $document->file_name);
        $this->assertSame('application/pdf', $document->mime_type);
        $this->assertSame('1024000', $document->file_size);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('document_minimal.json');
        $document = Document::fromArray($data);

        $this->assertInstanceOf(Document::class, $document);
        $this->assertNull($document->thumbnail);
        $this->assertNull($document->file_name);
        $this->assertNull($document->mime_type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('document_minimal.json');
        $document = Document::fromArray($data);
        $this->assertEquals($data, $document->toArray());
    }
}
