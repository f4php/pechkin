<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MessageAutoDeleteTimerChanged;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageAutoDeleteTimerChangedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_auto_delete_timer_changed_full.json');
        $messageAutoDeleteTimerChanged = MessageAutoDeleteTimerChanged::fromArray($data);

        $this->assertInstanceOf(MessageAutoDeleteTimerChanged::class, $messageAutoDeleteTimerChanged);
        $this->assertSame(86400, $messageAutoDeleteTimerChanged->message_auto_delete_time);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_auto_delete_timer_changed_minimal.json');
        $messageAutoDeleteTimerChanged = MessageAutoDeleteTimerChanged::fromArray($data);
        $this->assertEquals($data, $messageAutoDeleteTimerChanged->toArray());
    }
}
