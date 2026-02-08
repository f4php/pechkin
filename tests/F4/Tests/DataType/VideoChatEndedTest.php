<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\VideoChatEnded;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class VideoChatEndedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('video_chat_ended_full.json');
        $videoChatEnded = VideoChatEnded::fromArray($data);

        $this->assertInstanceOf(VideoChatEnded::class, $videoChatEnded);
        $this->assertSame(120, $videoChatEnded->duration);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('video_chat_ended_minimal.json');
        $videoChatEnded = VideoChatEnded::fromArray($data);
        $this->assertEquals($data, $videoChatEnded->toArray());
    }
}
