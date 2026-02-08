<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\SuggestedPostRefunded;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuggestedPostRefundedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('suggested_post_refunded_full.json');
        $suggestedPostRefunded = SuggestedPostRefunded::fromArray($data);

        $this->assertInstanceOf(SuggestedPostRefunded::class, $suggestedPostRefunded);
        $this->assertInstanceOf(Message::class, $suggestedPostRefunded->suggested_post_message);
        $this->assertSame('post_deleted', $suggestedPostRefunded->reason);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('suggested_post_refunded_minimal.json');
        $suggestedPostRefunded = SuggestedPostRefunded::fromArray($data);

        $this->assertInstanceOf(SuggestedPostRefunded::class, $suggestedPostRefunded);
        $this->assertNull($suggestedPostRefunded->suggested_post_message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('suggested_post_refunded_minimal.json');
        $suggestedPostRefunded = SuggestedPostRefunded::fromArray($data);
        $this->assertEquals($data, $suggestedPostRefunded->toArray());
    }
}
