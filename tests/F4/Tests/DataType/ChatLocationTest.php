<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatLocation;
use F4\Pechkin\DataType\Location;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatLocationTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_location_full.json');
        $chatLocation = ChatLocation::fromArray($data);

        $this->assertInstanceOf(ChatLocation::class, $chatLocation);
        $this->assertInstanceOf(Location::class, $chatLocation->location);
        $this->assertSame('123 Main St', $chatLocation->address);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_location_minimal.json');
        $chatLocation = ChatLocation::fromArray($data);
        $this->assertEquals($data, $chatLocation->toArray());
    }
}
