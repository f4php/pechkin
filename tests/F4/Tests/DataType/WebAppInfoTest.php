<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\WebAppInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WebAppInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('web_app_info_full.json');
        $webAppInfo = WebAppInfo::fromArray($data);

        $this->assertInstanceOf(WebAppInfo::class, $webAppInfo);
        $this->assertSame('https://example.com', $webAppInfo->url);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('web_app_info_minimal.json');
        $webAppInfo = WebAppInfo::fromArray($data);
        $this->assertEquals($data, $webAppInfo->toArray());
    }
}
