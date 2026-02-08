<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    MenuButton,
    WebAppInfo,
};

readonly class MenuButtonWebApp extends MenuButton
{
    public readonly string $type;
    public function __construct(
        public readonly string $text,
        public readonly WebAppInfo $web_app,
    ) {
        $this->type = 'web_app';
    }
}
