<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextDateTime;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextDateTimeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_date_time_full.json');
        $obj = RichTextDateTime::fromArray($data);

        $this->assertInstanceOf(RichTextDateTime::class, $obj);
        $this->assertSame('date_time', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame(1700000000, $obj->unix_time);
        $this->assertSame('Y-m-d', $obj->date_time_format);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_date_time_full.json');
        $obj = RichTextDateTime::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'date_time'], $obj->toArray());
    }
}
