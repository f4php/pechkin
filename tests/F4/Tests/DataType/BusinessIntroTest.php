<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BusinessIntro;
use F4\Pechkin\DataType\Sticker;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BusinessIntroTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('business_intro_full.json');
        $businessIntro = BusinessIntro::fromArray($data);

        $this->assertInstanceOf(BusinessIntro::class, $businessIntro);
        $this->assertInstanceOf(Sticker::class, $businessIntro->sticker);
        $this->assertSame('Test Title', $businessIntro->title);
        $this->assertSame('Error message', $businessIntro->message);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('business_intro_minimal.json');
        $businessIntro = BusinessIntro::fromArray($data);

        $this->assertInstanceOf(BusinessIntro::class, $businessIntro);
        $this->assertNull($businessIntro->title);
        $this->assertNull($businessIntro->message);
        $this->assertNull($businessIntro->sticker);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('business_intro_minimal.json');
        $businessIntro = BusinessIntro::fromArray($data);
        $this->assertEquals($data, $businessIntro->toArray());
    }
}
