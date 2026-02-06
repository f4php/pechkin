<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatBackground;
use F4\Pechkin\DataType\BackgroundType;

final class ChatBackgroundTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'type' => [
                'type' => 'chat_theme',
                'theme_name' => 'dark',
            ],
        ];
        $background = ChatBackground::fromArray($data);
        $this->assertInstanceOf(BackgroundType::class, $background->type);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'type' => [
                'type' => 'chat_theme',
                'theme_name' => 'default',
            ],
        ];
        $background = ChatBackground::fromArray($data);
        $this->assertSame($data, $background->toArray());
    }
}
