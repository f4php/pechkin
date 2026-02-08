<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\WebAppData;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WebAppDataTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('web_app_data_full.json');
        $webAppData = WebAppData::fromArray($data);

        $this->assertInstanceOf(WebAppData::class, $webAppData);
        $this->assertSame('callback_data_123', $webAppData->data);
        $this->assertSame('test_string', $webAppData->button_text);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('web_app_data_minimal.json');
        $webAppData = WebAppData::fromArray($data);
        $this->assertEquals($data, $webAppData->toArray());
    }
}
