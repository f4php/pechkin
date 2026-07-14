<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockFooter;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockFooterTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_footer_full.json');
        $obj = InputRichBlockFooter::fromArray($data);

        $this->assertInstanceOf(InputRichBlockFooter::class, $obj);
        $this->assertSame('footer', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_footer_full.json');
        $obj = InputRichBlockFooter::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'footer'], $obj->toArray());
    }
}
