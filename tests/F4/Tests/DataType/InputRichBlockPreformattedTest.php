<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockPreformatted;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockPreformattedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_preformatted_full.json');
        $obj = InputRichBlockPreformatted::fromArray($data);

        $this->assertInstanceOf(InputRichBlockPreformatted::class, $obj);
        $this->assertSame('pre', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('php', $obj->language);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_preformatted_minimal.json');
        $obj = InputRichBlockPreformatted::fromArray($data);

        $this->assertInstanceOf(InputRichBlockPreformatted::class, $obj);
        $this->assertNull($obj->language);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_preformatted_full.json');
        $obj = InputRichBlockPreformatted::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'pre'], $obj->toArray());
    }
}
