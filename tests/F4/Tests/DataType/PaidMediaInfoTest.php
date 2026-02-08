<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PaidMediaInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PaidMediaInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('paid_media_info_full.json');
        $paidMediaInfo = PaidMediaInfo::fromArray($data);

        $this->assertInstanceOf(PaidMediaInfo::class, $paidMediaInfo);
        $this->assertNotEmpty($paidMediaInfo->paid_media);
        $this->assertSame(100, $paidMediaInfo->star_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('paid_media_info_minimal.json');
        $paidMediaInfo = PaidMediaInfo::fromArray($data);
        $this->assertEquals($data, $paidMediaInfo->toArray());
    }
}
