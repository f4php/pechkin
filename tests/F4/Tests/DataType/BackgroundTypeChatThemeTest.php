<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BackgroundTypeChatTheme;

final class BackgroundTypeChatThemeTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = ['theme_name' => 'dark'];
        $theme = BackgroundTypeChatTheme::fromArray($data);
        $this->assertSame('dark', $theme->theme_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['theme_name' => 'arctic'];
        $theme = BackgroundTypeChatTheme::fromArray($data);
        $this->assertSame($data, $theme->toArray());
    }
}
