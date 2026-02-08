<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\VideoChatScheduled;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class VideoChatScheduledTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('video_chat_scheduled_full.json');
        $videoChatScheduled = VideoChatScheduled::fromArray($data);

        $this->assertInstanceOf(VideoChatScheduled::class, $videoChatScheduled);
        $this->assertSame(42, $videoChatScheduled->start_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('video_chat_scheduled_minimal.json');
        $videoChatScheduled = VideoChatScheduled::fromArray($data);
        $this->assertEquals($data, $videoChatScheduled->toArray());
    }
}
