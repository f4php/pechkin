<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatLocation;
use F4\Pechkin\DataType\Location;

final class ChatLocationTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'location' => [
                'latitude' => 37.7749,
                'longitude' => -122.4194,
            ],
            'address' => '123 Main St, San Francisco, CA',
        ];
        $chatLocation = ChatLocation::fromArray($data);

        $this->assertInstanceOf(Location::class, $chatLocation->location);
        $this->assertSame(37.7749, $chatLocation->location->latitude);
        $this->assertSame(-122.4194, $chatLocation->location->longitude);
        $this->assertSame('123 Main St, San Francisco, CA', $chatLocation->address);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'location' => [
                'latitude' => 37.7749,
                'longitude' => -122.4194,
                'horizontal_accuracy' => null,
                'live_period' => null,
                'heading' => null,
                'proximity_alert_radius' => null,
            ],
            'address' => '123 Main St, San Francisco, CA',
        ];
        $chatLocation = ChatLocation::fromArray($data);
        $this->assertSame($data, $chatLocation->toArray());
    }
}
