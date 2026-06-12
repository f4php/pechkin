<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextUrl;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextUrlTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_url_full.json');
        $obj = RichTextUrl::fromArray($data);

        $this->assertInstanceOf(RichTextUrl::class, $obj);
        $this->assertSame('url', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('https://example.com', $obj->url);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_url_full.json');
        $obj = RichTextUrl::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'url'], $obj->toArray());
    }
}
