<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\LivePhoto;
use F4\Pechkin\DataType\PaidMediaLivePhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PaidMediaLivePhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('paid_media_live_photo_full.json');
        $pmlp = PaidMediaLivePhoto::fromArray($data);

        $this->assertInstanceOf(PaidMediaLivePhoto::class, $pmlp);
        $this->assertSame('live_photo', $pmlp->type);
        $this->assertInstanceOf(LivePhoto::class, $pmlp->live_photo);
        $this->assertSame('BAACAgIAAxkBAAI', $pmlp->live_photo->file_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('paid_media_live_photo_minimal.json');
        $pmlp = PaidMediaLivePhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'live_photo'], $pmlp->toArray());
    }
}
