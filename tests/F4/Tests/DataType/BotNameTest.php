<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotName;

final class BotNameTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = ['name' => 'My Awesome Bot'];
        $name = BotName::fromArray($data);
        $this->assertSame('My Awesome Bot', $name->name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['name' => 'SuperBot'];
        $name = BotName::fromArray($data);
        $this->assertSame($data, $name->toArray());
    }
}
