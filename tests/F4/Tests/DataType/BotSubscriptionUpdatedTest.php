<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotSubscriptionUpdated;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotSubscriptionUpdatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_subscription_updated_full.json');
        $subscription = BotSubscriptionUpdated::fromArray($data);

        $this->assertInstanceOf(BotSubscriptionUpdated::class, $subscription);
        $this->assertInstanceOf(User::class, $subscription->user);
        $this->assertSame('sub-payload-123', $subscription->invoice_payload);
        $this->assertSame('active', $subscription->state);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('bot_subscription_updated_minimal.json');
        $subscription = BotSubscriptionUpdated::fromArray($data);

        $this->assertInstanceOf(BotSubscriptionUpdated::class, $subscription);
        $this->assertSame('active', $subscription->state);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_subscription_updated_minimal.json');
        $subscription = BotSubscriptionUpdated::fromArray($data);
        $this->assertEquals($data, $subscription->toArray());
    }
}
