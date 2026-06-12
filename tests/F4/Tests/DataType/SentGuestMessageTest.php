<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\SentGuestMessage;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SentGuestMessageTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('sent_guest_message_full.json');
        $msg = SentGuestMessage::fromArray($data);

        $this->assertInstanceOf(SentGuestMessage::class, $msg);
        $this->assertSame('inline_msg_456', $msg->inline_message_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('sent_guest_message_minimal.json');
        $msg = SentGuestMessage::fromArray($data);
        $this->assertEquals($data, $msg->toArray());
    }
}
