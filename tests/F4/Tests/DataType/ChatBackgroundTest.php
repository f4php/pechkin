<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BackgroundType;
use F4\Pechkin\DataType\ChatBackground;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatBackgroundTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_background_full.json');
        $chatBackground = ChatBackground::fromArray($data);

        $this->assertInstanceOf(ChatBackground::class, $chatBackground);
        $this->assertNotNull($chatBackground->type);
        $this->assertInstanceOf(BackgroundType::class, $chatBackground->type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_background_minimal.json');
        $chatBackground = ChatBackground::fromArray($data);
        $this->assertEquals($data, $chatBackground->toArray());
    }
}
