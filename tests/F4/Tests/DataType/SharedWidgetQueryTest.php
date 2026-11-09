<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\SharedWidgetQuery;
use F4\Pechkin\DataType\User;
use F4\Pechkin\DataType\WidgetQueryTypeData;
use F4\Pechkin\DataType\WidgetQueryTypeSignData;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SharedWidgetQueryTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('shared_widget_query_full.json');
        $query = SharedWidgetQuery::fromArray($data);

        $this->assertInstanceOf(SharedWidgetQuery::class, $query);
        $this->assertSame('query_123', $query->id);
        $this->assertInstanceOf(User::class, $query->from);
        $this->assertInstanceOf(WidgetQueryTypeSignData::class, $query->type);
        $this->assertSame('payload', $query->data);
        $this->assertSame('widget_123', $query->widget_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('shared_widget_query_minimal.json');
        $query = SharedWidgetQuery::fromArray($data);

        $this->assertInstanceOf(SharedWidgetQuery::class, $query);
        $this->assertInstanceOf(WidgetQueryTypeData::class, $query->type);
        $this->assertNull($query->from->last_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('shared_widget_query_minimal.json');
        $query = SharedWidgetQuery::fromArray($data);
        $this->assertEquals($data, $query->toArray());
    }
}
