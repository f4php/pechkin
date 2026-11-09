<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PaidMessagesWaived;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PaidMessagesWaivedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('paid_messages_waived_full.json');
        $paidMessagesWaived = PaidMessagesWaived::fromArray($data);

        $this->assertInstanceOf(PaidMessagesWaived::class, $paidMessagesWaived);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('paid_messages_waived_minimal.json');
        $paidMessagesWaived = PaidMessagesWaived::fromArray($data);
        $this->assertEquals($data, $paidMessagesWaived->toArray());
    }
}
