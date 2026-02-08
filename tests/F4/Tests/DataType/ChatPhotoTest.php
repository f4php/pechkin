<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatPhoto;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatPhotoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_photo_full.json');
        $chatPhoto = ChatPhoto::fromArray($data);

        $this->assertInstanceOf(ChatPhoto::class, $chatPhoto);
        $this->assertSame('BAACAgIAAxkBAAIsmall', $chatPhoto->small_file_id);
        $this->assertSame('AgADSmallUnique', $chatPhoto->small_file_unique_id);
        $this->assertSame('BAACAgIAAxkBAAIbig', $chatPhoto->big_file_id);
        $this->assertSame('AgADBigUnique', $chatPhoto->big_file_unique_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_photo_minimal.json');
        $chatPhoto = ChatPhoto::fromArray($data);
        $this->assertEquals($data, $chatPhoto->toArray());
    }
}
