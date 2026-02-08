<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PaidMediaPhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PaidMediaPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('paid_media_photo_full.json');
        $paidMediaPhoto = PaidMediaPhoto::fromArray($data);

        $this->assertInstanceOf(PaidMediaPhoto::class, $paidMediaPhoto);
        $this->assertNotEmpty($paidMediaPhoto->photo);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('paid_media_photo_minimal.json');
        $paidMediaPhoto = PaidMediaPhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'photo'], $paidMediaPhoto->toArray());
    }
}
