<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichBlockThinking;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichBlockThinkingTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_block_thinking_full.json');
        $obj = RichBlockThinking::fromArray($data);

        $this->assertInstanceOf(RichBlockThinking::class, $obj);
        $this->assertSame('thinking', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_block_thinking_full.json');
        $obj = RichBlockThinking::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'thinking'], $obj->toArray());
    }
}
