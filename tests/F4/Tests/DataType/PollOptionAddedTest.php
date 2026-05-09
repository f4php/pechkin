<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PollOptionAdded;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PollOptionAddedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('poll_option_added_full.json');
        $poa = PollOptionAdded::fromArray($data);

        $this->assertInstanceOf(PollOptionAdded::class, $poa);
        $this->assertSame('abc123', $poa->option_persistent_id);
        $this->assertSame('New option text', $poa->option_text);
        $this->assertNotNull($poa->poll_message);
        $this->assertIsArray($poa->option_text_entities);
        $this->assertCount(1, $poa->option_text_entities);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('poll_option_added_minimal.json');
        $poa = PollOptionAdded::fromArray($data);

        $this->assertInstanceOf(PollOptionAdded::class, $poa);
        $this->assertNull($poa->poll_message);
        $this->assertNull($poa->option_text_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('poll_option_added_minimal.json');
        $poa = PollOptionAdded::fromArray($data);
        $this->assertEquals($data, $poa->toArray());
    }
}
