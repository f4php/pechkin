<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\SuggestedPostApproved;
use F4\Pechkin\DataType\SuggestedPostPrice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuggestedPostApprovedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('suggested_post_approved_full.json');
        $suggestedPostApproved = SuggestedPostApproved::fromArray($data);

        $this->assertInstanceOf(SuggestedPostApproved::class, $suggestedPostApproved);
        $this->assertInstanceOf(Message::class, $suggestedPostApproved->suggested_post_message);
        $this->assertInstanceOf(SuggestedPostPrice::class, $suggestedPostApproved->price);
        $this->assertSame(1700000000, $suggestedPostApproved->send_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('suggested_post_approved_minimal.json');
        $suggestedPostApproved = SuggestedPostApproved::fromArray($data);

        $this->assertInstanceOf(SuggestedPostApproved::class, $suggestedPostApproved);
        $this->assertNull($suggestedPostApproved->suggested_post_message);
        $this->assertNull($suggestedPostApproved->price);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('suggested_post_approved_minimal.json');
        $suggestedPostApproved = SuggestedPostApproved::fromArray($data);
        $this->assertEquals($data, $suggestedPostApproved->toArray());
    }
}
