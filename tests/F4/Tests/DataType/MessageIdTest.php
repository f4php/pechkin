<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MessageId;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageIdTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_id_full.json');
        $messageId = MessageId::fromArray($data);

        $this->assertInstanceOf(MessageId::class, $messageId);
        $this->assertSame(42, $messageId->message_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_id_minimal.json');
        $messageId = MessageId::fromArray($data);
        $this->assertEquals($data, $messageId->toArray());
    }
}
