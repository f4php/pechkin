<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\UserProfilePhotos;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UserProfilePhotosTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('user_profile_photos_full.json');
        $userProfilePhotos = UserProfilePhotos::fromArray($data);

        $this->assertInstanceOf(UserProfilePhotos::class, $userProfilePhotos);
        $this->assertNotEmpty($userProfilePhotos->photos);
        $this->assertSame(10, $userProfilePhotos->total_count);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('user_profile_photos_minimal.json');
        $userProfilePhotos = UserProfilePhotos::fromArray($data);
        $this->assertEquals($data, $userProfilePhotos->toArray());
    }
}
