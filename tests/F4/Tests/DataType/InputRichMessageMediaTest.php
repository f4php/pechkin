<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputMedia;
use F4\Pechkin\DataType\InputMediaPhoto;
use F4\Pechkin\DataType\InputRichMessageMedia;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputRichMessageMediaTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_rich_message_media_full.json');
        $inputRichMessageMedia = InputRichMessageMedia::fromArray($data);

        $this->assertInstanceOf(InputRichMessageMedia::class, $inputRichMessageMedia);
        $this->assertSame('photo-1', $inputRichMessageMedia->id);
        $this->assertInstanceOf(InputMedia::class, $inputRichMessageMedia->media);
        $this->assertInstanceOf(InputMediaPhoto::class, $inputRichMessageMedia->media);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_rich_message_media_minimal.json');
        $inputRichMessageMedia = InputRichMessageMedia::fromArray($data);
        $this->assertEquals($data, $inputRichMessageMedia->toArray());
    }
}
