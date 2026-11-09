<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\User;
use F4\Pechkin\DataType\WidgetQuery;
use F4\Pechkin\DataType\WidgetQueryTypeData;
use F4\Pechkin\DataType\WidgetQueryTypeSignData;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WidgetQueryTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('widget_query_full.json');
        $query = WidgetQuery::fromArray($data);

        $this->assertInstanceOf(WidgetQuery::class, $query);
        $this->assertSame('query_123', $query->id);
        $this->assertInstanceOf(User::class, $query->from);
        $this->assertInstanceOf(Chat::class, $query->chat);
        $this->assertSame(42, $query->message_id);
        $this->assertSame('inline_123', $query->inline_message_id);
        $this->assertSame('instance_456', $query->chat_instance);
        $this->assertSame('private', $query->chat_type);
        $this->assertInstanceOf(WidgetQueryTypeSignData::class, $query->type);
        $this->assertSame('payload', $query->data);
        $this->assertSame('widget_123', $query->widget_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('widget_query_minimal.json');
        $query = WidgetQuery::fromArray($data);

        $this->assertInstanceOf(WidgetQuery::class, $query);
        $this->assertInstanceOf(WidgetQueryTypeData::class, $query->type);
        $this->assertNull($query->chat);
        $this->assertNull($query->message_id);
        $this->assertNull($query->inline_message_id);
        $this->assertNull($query->chat_type);
        $this->assertNull($query->widget_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('widget_query_minimal.json');
        $query = WidgetQuery::fromArray($data);
        $this->assertEquals($data, $query->toArray());
    }
}
