<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\InaccessibleMessage;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InaccessibleMessageTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inaccessible_message_full.json');
        $inaccessibleMessage = InaccessibleMessage::fromArray($data);

        $this->assertInstanceOf(InaccessibleMessage::class, $inaccessibleMessage);
        $this->assertInstanceOf(Chat::class, $inaccessibleMessage->chat);
        $this->assertSame('42', $inaccessibleMessage->message_id);
        $this->assertSame(0, $inaccessibleMessage->date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inaccessible_message_minimal.json');
        $inaccessibleMessage = InaccessibleMessage::fromArray($data);
        $this->assertEquals($data, $inaccessibleMessage->toArray());
    }
}
