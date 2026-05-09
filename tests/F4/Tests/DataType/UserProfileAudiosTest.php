<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Audio;
use F4\Pechkin\DataType\UserProfileAudios;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UserProfileAudiosTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('user_profile_audios_full.json');
        $upa = UserProfileAudios::fromArray($data);

        $this->assertInstanceOf(UserProfileAudios::class, $upa);
        $this->assertSame(1, $upa->total_count);
        $this->assertCount(1, $upa->audios);
        $this->assertInstanceOf(Audio::class, $upa->audios[0]);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('user_profile_audios_minimal.json');
        $upa = UserProfileAudios::fromArray($data);

        $this->assertInstanceOf(UserProfileAudios::class, $upa);
        $this->assertSame(0, $upa->total_count);
        $this->assertSame([], $upa->audios);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('user_profile_audios_minimal.json');
        $upa = UserProfileAudios::fromArray($data);
        $this->assertEquals($data, $upa->toArray());
    }
}
