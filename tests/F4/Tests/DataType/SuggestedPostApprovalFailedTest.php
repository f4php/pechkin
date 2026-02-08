<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\SuggestedPostApprovalFailed;
use F4\Pechkin\DataType\SuggestedPostPrice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuggestedPostApprovalFailedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('suggested_post_approval_failed_full.json');
        $suggestedPostApprovalFailed = SuggestedPostApprovalFailed::fromArray($data);

        $this->assertInstanceOf(SuggestedPostApprovalFailed::class, $suggestedPostApprovalFailed);
        $this->assertInstanceOf(SuggestedPostPrice::class, $suggestedPostApprovalFailed->price);
        $this->assertInstanceOf(Message::class, $suggestedPostApprovalFailed->suggested_post_message);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('suggested_post_approval_failed_minimal.json');
        $suggestedPostApprovalFailed = SuggestedPostApprovalFailed::fromArray($data);

        $this->assertInstanceOf(SuggestedPostApprovalFailed::class, $suggestedPostApprovalFailed);
        $this->assertNull($suggestedPostApprovalFailed->suggested_post_message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('suggested_post_approval_failed_minimal.json');
        $suggestedPostApprovalFailed = SuggestedPostApprovalFailed::fromArray($data);
        $this->assertEquals($data, $suggestedPostApprovalFailed->toArray());
    }
}
