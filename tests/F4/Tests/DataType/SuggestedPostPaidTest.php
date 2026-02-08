<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\StarAmount;
use F4\Pechkin\DataType\SuggestedPostPaid;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuggestedPostPaidTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('suggested_post_paid_full.json');
        $suggestedPostPaid = SuggestedPostPaid::fromArray($data);

        $this->assertInstanceOf(SuggestedPostPaid::class, $suggestedPostPaid);
        $this->assertInstanceOf(Message::class, $suggestedPostPaid->suggested_post_message);
        $this->assertInstanceOf(StarAmount::class, $suggestedPostPaid->star_amount);
        $this->assertSame('USD', $suggestedPostPaid->currency);
        $this->assertSame(1000, $suggestedPostPaid->amount);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('suggested_post_paid_minimal.json');
        $suggestedPostPaid = SuggestedPostPaid::fromArray($data);

        $this->assertInstanceOf(SuggestedPostPaid::class, $suggestedPostPaid);
        $this->assertNull($suggestedPostPaid->suggested_post_message);
        $this->assertNull($suggestedPostPaid->amount);
        $this->assertNull($suggestedPostPaid->star_amount);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('suggested_post_paid_minimal.json');
        $suggestedPostPaid = SuggestedPostPaid::fromArray($data);
        $this->assertEquals($data, $suggestedPostPaid->toArray());
    }
}
