<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\MessageGenerationStopped;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageGenerationStoppedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_generation_stopped_full.json');
        $obj = MessageGenerationStopped::fromArray($data);

        $this->assertInstanceOf(MessageGenerationStopped::class, $obj);
        $this->assertInstanceOf(Chat::class, $obj->chat);
        $this->assertSame(42, $obj->draft_id);
        $this->assertSame(7, $obj->message_thread_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('message_generation_stopped_minimal.json');
        $obj = MessageGenerationStopped::fromArray($data);

        $this->assertInstanceOf(MessageGenerationStopped::class, $obj);
        $this->assertInstanceOf(Chat::class, $obj->chat);
        $this->assertSame(42, $obj->draft_id);
        $this->assertNull($obj->message_thread_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_generation_stopped_minimal.json');
        $obj = MessageGenerationStopped::fromArray($data);
        $this->assertEquals($data, $obj->toArray());
    }
}
