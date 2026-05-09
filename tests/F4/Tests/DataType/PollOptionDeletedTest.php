<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PollOptionDeleted;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PollOptionDeletedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('poll_option_deleted_full.json');
        $pod = PollOptionDeleted::fromArray($data);

        $this->assertInstanceOf(PollOptionDeleted::class, $pod);
        $this->assertSame('abc123', $pod->option_persistent_id);
        $this->assertSame('Deleted option text', $pod->option_text);
        $this->assertNotNull($pod->poll_message);
        $this->assertNull($pod->option_text_entities);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('poll_option_deleted_minimal.json');
        $pod = PollOptionDeleted::fromArray($data);

        $this->assertInstanceOf(PollOptionDeleted::class, $pod);
        $this->assertNull($pod->poll_message);
        $this->assertNull($pod->option_text_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('poll_option_deleted_minimal.json');
        $pod = PollOptionDeleted::fromArray($data);
        $this->assertEquals($data, $pod->toArray());
    }
}
