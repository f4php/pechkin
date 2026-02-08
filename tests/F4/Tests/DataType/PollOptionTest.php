<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PollOption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PollOptionTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('poll_option_full.json');
        $pollOption = PollOption::fromArray($data);

        $this->assertInstanceOf(PollOption::class, $pollOption);
        $this->assertNotEmpty($pollOption->text_entities);
        $this->assertSame('Hello, World!', $pollOption->text);
        $this->assertSame(15, $pollOption->voter_count);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('poll_option_minimal.json');
        $pollOption = PollOption::fromArray($data);

        $this->assertInstanceOf(PollOption::class, $pollOption);
        $this->assertNull($pollOption->text_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('poll_option_minimal.json');
        $pollOption = PollOption::fromArray($data);
        $this->assertEquals($data, $pollOption->toArray());
    }
}
