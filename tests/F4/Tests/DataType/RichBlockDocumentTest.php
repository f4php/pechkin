<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Document;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Pechkin\DataType\RichBlockDocument;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockDocumentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_document_full.json');
        $obj = RichBlockDocument::fromArray($data);

        $this->assertInstanceOf(RichBlockDocument::class, $obj);
        $this->assertSame('document', $obj->type);
        $this->assertInstanceOf(Document::class, $obj->document);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('rich_block_document_minimal.json');
        $obj = RichBlockDocument::fromArray($data);

        $this->assertInstanceOf(RichBlockDocument::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_document_full.json');
        $obj = RichBlockDocument::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'document'], $obj->toArray());
    }
}
