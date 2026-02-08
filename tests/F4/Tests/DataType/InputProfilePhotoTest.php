<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\{
    InputProfilePhoto,
    InputProfilePhotoAnimated,
    InputProfilePhotoStatic,
};

final class InputProfilePhotoTest extends TestCase
{
    use FixtureAwareTrait;


    public function testFromArrayWithStaticType(): void
    {
        $data = [
            ...$this->loadFixture('input_profile_photo_static_full.json'),
            'type' => 'static',
        ];
        $result = InputProfilePhoto::fromArray($data);
        $this->assertInstanceOf(InputProfilePhotoStatic::class, $result);
    }

    public function testFromArrayWithAnimatedType(): void
    {
        $data = [
            ...$this->loadFixture('input_profile_photo_animated_full.json'),
            'type' => 'animated',
        ];
        $result = InputProfilePhoto::fromArray($data);
        $this->assertInstanceOf(InputProfilePhotoAnimated::class, $result);
    }

}
