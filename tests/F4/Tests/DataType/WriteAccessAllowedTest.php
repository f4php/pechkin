<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\WriteAccessAllowed;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WriteAccessAllowedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('write_access_allowed_full.json');
        $writeAccessAllowed = WriteAccessAllowed::fromArray($data);

        $this->assertInstanceOf(WriteAccessAllowed::class, $writeAccessAllowed);
        $this->assertSame(true, $writeAccessAllowed->from_request);
        $this->assertSame('TestWebApp', $writeAccessAllowed->web_app_name);
        $this->assertSame(true, $writeAccessAllowed->from_attachment_menu);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('write_access_allowed_minimal.json');
        $writeAccessAllowed = WriteAccessAllowed::fromArray($data);

        $this->assertInstanceOf(WriteAccessAllowed::class, $writeAccessAllowed);
        $this->assertNull($writeAccessAllowed->from_request);
        $this->assertNull($writeAccessAllowed->web_app_name);
        $this->assertNull($writeAccessAllowed->from_attachment_menu);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('write_access_allowed_minimal.json');
        $writeAccessAllowed = WriteAccessAllowed::fromArray($data);
        $this->assertEquals($data, $writeAccessAllowed->toArray());
    }
}
