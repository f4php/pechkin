<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotDescription;

final class BotDescriptionTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = ['description' => 'This is a helpful bot that does things.'];
        $desc = BotDescription::fromArray($data);
        $this->assertSame('This is a helpful bot that does things.', $desc->description);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['description' => 'A great bot'];
        $desc = BotDescription::fromArray($data);
        $this->assertSame($data, $desc->toArray());
    }
}
