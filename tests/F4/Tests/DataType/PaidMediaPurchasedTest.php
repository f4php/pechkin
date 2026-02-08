<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PaidMediaPurchased;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PaidMediaPurchasedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('paid_media_purchased_full.json');
        $paidMediaPurchased = PaidMediaPurchased::fromArray($data);

        $this->assertInstanceOf(PaidMediaPurchased::class, $paidMediaPurchased);
        $this->assertInstanceOf(User::class, $paidMediaPurchased->from);
        $this->assertSame('test_string', $paidMediaPurchased->paid_media_payload);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('paid_media_purchased_minimal.json');
        $paidMediaPurchased = PaidMediaPurchased::fromArray($data);
        $this->assertEquals($data, $paidMediaPurchased->toArray());
    }
}
