<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\SentWebAppMessage;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SentWebAppMessageTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('sent_web_app_message_full.json');
        $sentWebAppMessage = SentWebAppMessage::fromArray($data);

        $this->assertInstanceOf(SentWebAppMessage::class, $sentWebAppMessage);
        $this->assertSame('inline_msg_123', $sentWebAppMessage->inline_message_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('sent_web_app_message_minimal.json');
        $sentWebAppMessage = SentWebAppMessage::fromArray($data);

        $this->assertInstanceOf(SentWebAppMessage::class, $sentWebAppMessage);
        $this->assertNull($sentWebAppMessage->inline_message_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('sent_web_app_message_minimal.json');
        $sentWebAppMessage = SentWebAppMessage::fromArray($data);
        $this->assertEquals($data, $sentWebAppMessage->toArray());
    }
}
