<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaDocument;
use F4\Pechkin\DataType\InputRichBlockDocument;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockDocumentTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_document_full.json');
        $obj = InputRichBlockDocument::fromArray($data);

        $this->assertInstanceOf(InputRichBlockDocument::class, $obj);
        $this->assertSame('document', $obj->type);
        $this->assertInstanceOf(InputMediaDocument::class, $obj->document);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_document_minimal.json');
        $obj = InputRichBlockDocument::fromArray($data);

        $this->assertInstanceOf(InputRichBlockDocument::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_document_full.json');
        $obj = InputRichBlockDocument::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'document', 'document' => [...$data['document'], 'type' => 'document']], $obj->toArray());
    }
}
