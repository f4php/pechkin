<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\VideoChatStarted;

final class VideoChatStartedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [];
        $videoChatStarted = VideoChatStarted::fromArray($data);

        $this->assertInstanceOf(VideoChatStarted::class, $videoChatStarted);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [];
        $videoChatStarted = VideoChatStarted::fromArray($data);
        $this->assertEquals($data, $videoChatStarted->toArray());
    }
}
