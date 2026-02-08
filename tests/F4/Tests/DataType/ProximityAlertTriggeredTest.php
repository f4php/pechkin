<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ProximityAlertTriggered;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ProximityAlertTriggeredTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('proximity_alert_triggered_full.json');
        $proximityAlertTriggered = ProximityAlertTriggered::fromArray($data);

        $this->assertInstanceOf(ProximityAlertTriggered::class, $proximityAlertTriggered);
        $this->assertInstanceOf(User::class, $proximityAlertTriggered->traveler);
        $this->assertInstanceOf(User::class, $proximityAlertTriggered->watcher);
        $this->assertSame(100, $proximityAlertTriggered->distance);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('proximity_alert_triggered_minimal.json');
        $proximityAlertTriggered = ProximityAlertTriggered::fromArray($data);
        $this->assertEquals($data, $proximityAlertTriggered->toArray());
    }
}
