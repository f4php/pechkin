<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockThinking;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockThinkingTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_thinking_full.json');
        $obj = InputRichBlockThinking::fromArray($data);

        $this->assertInstanceOf(InputRichBlockThinking::class, $obj);
        $this->assertSame('thinking', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_thinking_full.json');
        $obj = InputRichBlockThinking::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'thinking'], $obj->toArray());
    }
}
