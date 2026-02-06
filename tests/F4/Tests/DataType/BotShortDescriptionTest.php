<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BotShortDescription;

final class BotShortDescriptionTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = ['short_description' => 'A helpful bot'];
        $desc = BotShortDescription::fromArray($data);
        $this->assertSame('A helpful bot', $desc->short_description);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = ['short_description' => 'Quick helper'];
        $desc = BotShortDescription::fromArray($data);
        $this->assertSame($data, $desc->toArray());
    }
}
