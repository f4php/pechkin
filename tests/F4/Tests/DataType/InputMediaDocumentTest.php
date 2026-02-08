<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaDocument;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaDocumentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_document_full.json');
        $inputMediaDocument = InputMediaDocument::fromArray($data);

        $this->assertInstanceOf(InputMediaDocument::class, $inputMediaDocument);
        $this->assertNotEmpty($inputMediaDocument->caption_entities);
        $this->assertSame('attach://file', $inputMediaDocument->media);
        $this->assertSame('test_string', $inputMediaDocument->thumbnail);
        $this->assertSame('Test caption', $inputMediaDocument->caption);
        $this->assertSame('HTML', $inputMediaDocument->parse_mode);
        $this->assertSame(false, $inputMediaDocument->disable_content_type_detection);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_document_minimal.json');
        $inputMediaDocument = InputMediaDocument::fromArray($data);

        $this->assertInstanceOf(InputMediaDocument::class, $inputMediaDocument);
        $this->assertNull($inputMediaDocument->thumbnail);
        $this->assertNull($inputMediaDocument->caption);
        $this->assertNull($inputMediaDocument->parse_mode);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_document_minimal.json');
        $inputMediaDocument = InputMediaDocument::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'document'], $inputMediaDocument->toArray());
    }
}
