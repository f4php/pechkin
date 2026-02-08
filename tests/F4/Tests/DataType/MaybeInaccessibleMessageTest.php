<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\MaybeInaccessibleMessage;
use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\InaccessibleMessage;

final class MaybeInaccessibleMessageTest extends TestCase
{
    use FixtureAwareTrait;


    public function testFromArrayWithAccessibleMessage(): void
    {
        $data = $this->loadFixture('message_full.json');;
        $result = MaybeInaccessibleMessage::fromArray($data);
        $this->assertInstanceOf(Message::class, $result);
    }

    public function testFromArrayWithInaccessibleMessage(): void
    {
        $data = $data = $this->loadFixture('inaccessible_message_full.json');;;
        $result = MaybeInaccessibleMessage::fromArray($data);
        $this->assertInstanceOf(InaccessibleMessage::class, $result);
    }
}
