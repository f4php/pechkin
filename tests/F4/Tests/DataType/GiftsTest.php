<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Gifts;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class GiftsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('gifts_full.json');
        $gifts = Gifts::fromArray($data);

        $this->assertInstanceOf(Gifts::class, $gifts);
        $this->assertNotEmpty($gifts->gifts);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('gifts_minimal.json');
        $gifts = Gifts::fromArray($data);
        $this->assertEquals($data, $gifts->toArray());
    }
}
