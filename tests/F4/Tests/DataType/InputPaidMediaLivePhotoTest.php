<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputPaidMediaLivePhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputPaidMediaLivePhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_paid_media_live_photo_full.json');
        $ipmlp = InputPaidMediaLivePhoto::fromArray($data);

        $this->assertInstanceOf(InputPaidMediaLivePhoto::class, $ipmlp);
        $this->assertSame('live_photo', $ipmlp->type);
        $this->assertSame('attach://live_photo', $ipmlp->media);
        $this->assertSame('attach://preview_photo', $ipmlp->photo);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_paid_media_live_photo_minimal.json');
        $ipmlp = InputPaidMediaLivePhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'live_photo'], $ipmlp->toArray());
    }
}
