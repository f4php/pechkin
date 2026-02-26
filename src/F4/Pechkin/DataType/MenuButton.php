<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    MenuButtonCommands,
    MenuButtonDefault,
    MenuButtonWebApp,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'commands' => MenuButtonCommands::class,
    'default' => MenuButtonDefault::class,
    'web_app' => MenuButtonWebApp::class,
])]
abstract readonly class MenuButton extends AbstractDataType
{
    public readonly string $type;
}
