<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputPaidMediaPhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputPaidMediaPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_paid_media_photo_full.json');
        $inputPaidMediaPhoto = InputPaidMediaPhoto::fromArray($data);

        $this->assertInstanceOf(InputPaidMediaPhoto::class, $inputPaidMediaPhoto);
        $this->assertSame('attach://file', $inputPaidMediaPhoto->media);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_paid_media_photo_minimal.json');
        $inputPaidMediaPhoto = InputPaidMediaPhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'photo'], $inputPaidMediaPhoto->toArray());
    }
}
