<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BusinessMessagesDeleted;
use F4\Pechkin\DataType\Chat;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BusinessMessagesDeletedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('business_messages_deleted_full.json');
        $businessMessagesDeleted = BusinessMessagesDeleted::fromArray($data);

        $this->assertInstanceOf(BusinessMessagesDeleted::class, $businessMessagesDeleted);
        $this->assertInstanceOf(Chat::class, $businessMessagesDeleted->chat);
        $this->assertNotEmpty($businessMessagesDeleted->message_ids);
        $this->assertSame('biz_conn_123', $businessMessagesDeleted->business_connection_id);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('business_messages_deleted_minimal.json');
        $businessMessagesDeleted = BusinessMessagesDeleted::fromArray($data);
        $this->assertEquals($data, $businessMessagesDeleted->toArray());
    }
}
