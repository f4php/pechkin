<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BusinessIntro;

final class BusinessIntroTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'title' => 'Welcome',
            'message' => 'Hello, how can I help you?',
            'sticker' => [
                'file_id' => '928497239842',
                'file_unique_id' => '213432095349873',
                'type' => 'regular',
                'width' => 100,
                'height' => 100,
                'is_animated' => true,
                'is_video' => true,
            ],
        ];
        $intro = BusinessIntro::fromArray($data);
        $this->assertSame('Welcome', $intro->title);
        $this->assertSame('Hello, how can I help you?', $intro->message);
    }

    public function testFromArrayCreatesCorrectStructureMinimalData(): void
    {
        $data = [];
        $intro = BusinessIntro::fromArray($data);
        $this->assertNull($intro->title);
        $this->assertNull($intro->message);
        $this->assertNull($intro->sticker);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'title' => 'Welcome',
            'message' => 'Hello, how can I help you?',
            'sticker' => [
                'file_id' => '928497239842',
                'file_unique_id' => '213432095349873',
                'type' => 'regular',
                'width' => 100,
                'height' => 100,
                'is_animated' => true,
                'is_video' => true,
            ],
        ];
        $intro = BusinessIntro::fromArray($data);
        $this->assertSame($data, $intro->toArray());
    }
}
