<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Widget;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WidgetTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('widget_full.json');
        $widget = Widget::fromArray($data);

        $this->assertInstanceOf(Widget::class, $widget);
        $this->assertSame('<div>Hello</div>', $widget->html);
        $this->assertSame('widget_123', $widget->id);
        $this->assertSame(320, $widget->width);
        $this->assertSame(200, $widget->height);
        $this->assertSame('public', $widget->public_data);
        $this->assertSame('chat', $widget->chat_data);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('widget_minimal.json');
        $widget = Widget::fromArray($data);

        $this->assertInstanceOf(Widget::class, $widget);
        $this->assertSame('<div>Hello</div>', $widget->html);
        $this->assertNull($widget->id);
        $this->assertNull($widget->width);
        $this->assertNull($widget->height);
        $this->assertNull($widget->public_data);
        $this->assertNull($widget->chat_data);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('widget_minimal.json');
        $widget = Widget::fromArray($data);
        $this->assertEquals($data, $widget->toArray());
    }
}
