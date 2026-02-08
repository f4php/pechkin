<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\SuggestedPostInfo;
use F4\Pechkin\DataType\SuggestedPostPrice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuggestedPostInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('suggested_post_info_full.json');
        $suggestedPostInfo = SuggestedPostInfo::fromArray($data);

        $this->assertInstanceOf(SuggestedPostInfo::class, $suggestedPostInfo);
        $this->assertInstanceOf(SuggestedPostPrice::class, $suggestedPostInfo->price);
        $this->assertSame('pending', $suggestedPostInfo->state);
        $this->assertSame(1700000000, $suggestedPostInfo->send_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('suggested_post_info_minimal.json');
        $suggestedPostInfo = SuggestedPostInfo::fromArray($data);

        $this->assertInstanceOf(SuggestedPostInfo::class, $suggestedPostInfo);
        $this->assertNull($suggestedPostInfo->price);
        $this->assertNull($suggestedPostInfo->send_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('suggested_post_info_minimal.json');
        $suggestedPostInfo = SuggestedPostInfo::fromArray($data);
        $this->assertEquals($data, $suggestedPostInfo->toArray());
    }
}
