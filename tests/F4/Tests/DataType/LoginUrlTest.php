<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\LoginUrl;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class LoginUrlTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('login_url_full.json');
        $loginUrl = LoginUrl::fromArray($data);

        $this->assertInstanceOf(LoginUrl::class, $loginUrl);
        $this->assertSame('https://example.com', $loginUrl->url);
        $this->assertSame('Forward text', $loginUrl->forward_text);
        $this->assertSame('testbot', $loginUrl->bot_username);
        $this->assertSame(true, $loginUrl->request_write_access);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('login_url_minimal.json');
        $loginUrl = LoginUrl::fromArray($data);

        $this->assertInstanceOf(LoginUrl::class, $loginUrl);
        $this->assertNull($loginUrl->forward_text);
        $this->assertNull($loginUrl->bot_username);
        $this->assertNull($loginUrl->request_write_access);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('login_url_minimal.json');
        $loginUrl = LoginUrl::fromArray($data);
        $this->assertEquals($data, $loginUrl->toArray());
    }
}
