<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChosenInlineResult;
use F4\Pechkin\DataType\Location;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChosenInlineResultTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chosen_inline_result_full.json');
        $chosenInlineResult = ChosenInlineResult::fromArray($data);

        $this->assertInstanceOf(ChosenInlineResult::class, $chosenInlineResult);
        $this->assertInstanceOf(User::class, $chosenInlineResult->from);
        $this->assertInstanceOf(Location::class, $chosenInlineResult->location);
        $this->assertSame('result_1', $chosenInlineResult->result_id);
        $this->assertSame('test query', $chosenInlineResult->query);
        $this->assertSame('inline_msg_123', $chosenInlineResult->inline_message_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chosen_inline_result_minimal.json');
        $chosenInlineResult = ChosenInlineResult::fromArray($data);

        $this->assertInstanceOf(ChosenInlineResult::class, $chosenInlineResult);
        $this->assertNull($chosenInlineResult->location);
        $this->assertNull($chosenInlineResult->inline_message_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chosen_inline_result_minimal.json');
        $chosenInlineResult = ChosenInlineResult::fromArray($data);
        $this->assertEquals($data, $chosenInlineResult->toArray());
    }
}
