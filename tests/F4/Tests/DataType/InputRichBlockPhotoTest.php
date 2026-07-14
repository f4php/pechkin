<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputRichBlockPhoto;
use F4\Pechkin\DataType\InputMediaPhoto;
use F4\Pechkin\DataType\RichBlockCaption;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichBlockPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_block_photo_full.json');
        $obj = InputRichBlockPhoto::fromArray($data);

        $this->assertInstanceOf(InputRichBlockPhoto::class, $obj);
        $this->assertSame('photo', $obj->type);
        $this->assertInstanceOf(InputMediaPhoto::class, $obj->photo);
        $this->assertInstanceOf(RichBlockCaption::class, $obj->caption);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_rich_block_photo_minimal.json');
        $obj = InputRichBlockPhoto::fromArray($data);

        $this->assertInstanceOf(InputRichBlockPhoto::class, $obj);
        $this->assertNull($obj->caption);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_block_photo_full.json');
        $obj = InputRichBlockPhoto::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'photo', 'photo' => [...$data['photo'], 'type' => 'photo']], $obj->toArray());
    }
}
