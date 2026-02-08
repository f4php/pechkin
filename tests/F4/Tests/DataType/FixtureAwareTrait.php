<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use function 
    file_get_contents,
    json_decode
;

trait FixtureAwareTrait
{
    private function loadFixture(string $name): array
    {
        return json_decode(file_get_contents(__DIR__ . '/Fixtures/' . $name), true);
    }
}
