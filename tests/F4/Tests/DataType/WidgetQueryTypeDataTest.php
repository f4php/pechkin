<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\TonWalletCard;
use F4\Pechkin\DataType\WidgetQueryTypeData;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WidgetQueryTypeDataTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('widget_query_type_data_full.json');
        $queryType = WidgetQueryTypeData::fromArray($data);

        $this->assertInstanceOf(WidgetQueryTypeData::class, $queryType);
        $this->assertSame('data', $queryType->type);
        $this->assertInstanceOf(TonWalletCard::class, $queryType->wallet_card);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('widget_query_type_data_minimal.json');
        $queryType = WidgetQueryTypeData::fromArray($data);

        $this->assertInstanceOf(WidgetQueryTypeData::class, $queryType);
        $this->assertSame('data', $queryType->type);
        $this->assertNull($queryType->wallet_card);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('widget_query_type_data_minimal.json');
        $queryType = WidgetQueryTypeData::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'data'], $queryType->toArray());
    }
}
