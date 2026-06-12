<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMediaLink;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputMediaLinkTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_media_link_full.json');
        $obj = InputMediaLink::fromArray($data);

        $this->assertInstanceOf(InputMediaLink::class, $obj);
        $this->assertSame('link', $obj->type);
        $this->assertSame('https://example.com/media.jpg', $obj->url);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_media_link_full.json');
        $obj = InputMediaLink::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'link'], $obj->toArray());
    }
}
