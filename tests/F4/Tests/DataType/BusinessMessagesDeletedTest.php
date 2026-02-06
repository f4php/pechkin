<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BusinessMessagesDeleted;
use F4\Pechkin\DataType\Chat;

final class BusinessMessagesDeletedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'business_connection_id' => 'conn_123',
            'chat' => ['id' => '456', 'type' => 'private'],
            'message_ids' => ['1', '2', '3'],
        ];
        $deleted = BusinessMessagesDeleted::fromArray($data);
        $this->assertSame('conn_123', $deleted->business_connection_id);
        $this->assertInstanceOf(Chat::class, $deleted->chat);
        $this->assertSame(['1', '2', '3'], $deleted->message_ids);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'business_connection_id' => 'conn_789',
            'chat' => ['id' => '111', 'type' => 'channel'],
            'message_ids' => ['100'],
        ];
        $deleted = BusinessMessagesDeleted::fromArray($data);
        $this->assertSame($data, $deleted->toArray());
    }
}
