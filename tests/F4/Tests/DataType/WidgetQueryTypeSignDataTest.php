<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\WidgetQueryTypeSignData;
use F4\Pechkin\DataType\WidgetQueryWallet;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WidgetQueryTypeSignDataTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('widget_query_type_sign_data_full.json');
        $queryType = WidgetQueryTypeSignData::fromArray($data);

        $this->assertInstanceOf(WidgetQueryTypeSignData::class, $queryType);
        $this->assertSame('sign_data', $queryType->type);
        $this->assertInstanceOf(WidgetQueryWallet::class, $queryType->wallet);
        $this->assertSame('a1b2c3d4e5f6', $queryType->wallet->public_key);
        $this->assertSame('{"signature":"abc"}', $queryType->sign_data);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('widget_query_type_sign_data_minimal.json');
        $queryType = WidgetQueryTypeSignData::fromArray($data);

        $this->assertInstanceOf(WidgetQueryTypeSignData::class, $queryType);
        $this->assertNull($queryType->wallet->public_key);
        $this->assertNull($queryType->wallet->state_init);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('widget_query_type_sign_data_minimal.json');
        $queryType = WidgetQueryTypeSignData::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'sign_data'], $queryType->toArray());
    }
}
