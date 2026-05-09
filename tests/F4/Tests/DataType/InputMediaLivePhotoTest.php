<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaLivePhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaLivePhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_live_photo_full.json');
        $imlp = InputMediaLivePhoto::fromArray($data);

        $this->assertInstanceOf(InputMediaLivePhoto::class, $imlp);
        $this->assertSame('live_photo', $imlp->type);
        $this->assertSame('attach://live_photo', $imlp->media);
        $this->assertSame('attach://preview_photo', $imlp->photo);
        $this->assertSame('Live photo caption', $imlp->caption);
        $this->assertSame('HTML', $imlp->parse_mode);
        $this->assertTrue($imlp->show_caption_above_media);
        $this->assertFalse($imlp->has_spoiler);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_media_live_photo_minimal.json');
        $imlp = InputMediaLivePhoto::fromArray($data);

        $this->assertInstanceOf(InputMediaLivePhoto::class, $imlp);
        $this->assertSame('live_photo', $imlp->type);
        $this->assertNull($imlp->caption);
        $this->assertNull($imlp->parse_mode);
        $this->assertNull($imlp->caption_entities);
        $this->assertNull($imlp->show_caption_above_media);
        $this->assertNull($imlp->has_spoiler);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_live_photo_minimal.json');
        $imlp = InputMediaLivePhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'live_photo'], $imlp->toArray());
    }
}
