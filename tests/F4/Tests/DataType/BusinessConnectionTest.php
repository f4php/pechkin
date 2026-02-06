<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BusinessBotRights;
use F4\Pechkin\DataType\BusinessConnection;
use F4\Pechkin\DataType\User;

final class BusinessConnectionTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'id' => 'conn_123',
            'user' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Business'],
            'user_chat_id' => '789012345678',
            'date' => 1700000000,
            'rights' => [
                'can_reply' => true,
                'can_read_messages' => true,
                'can_delete_sent_messages' => true,
                'can_delete_all_messages' => true,
                'can_edit_name' => true,
                'can_edit_bio' => true,
                'can_edit_profile_photo' => true,
                'can_edit_username' => true,
                'can_change_gift_settings' => true,
                'can_view_gifts_and_stars' => true,
                'can_convert_gifts_to_stars' => true,
                'can_transfer_and_upgrade_gifts' => true,
                'can_transfer_stars' => true,
                'can_manage_stories' => true,
            ],
            'is_enabled' => true,
        ];
        $conn = BusinessConnection::fromArray($data);
        $this->assertSame('conn_123', $conn->id);
        $this->assertInstanceOf(User::class, $conn->user);
        $this->assertSame('789012345678', $conn->user_chat_id);
        $this->assertInstanceOf(BusinessBotRights::class, $conn->rights);
        $this->assertTrue($conn->is_enabled);
    }

    public function testFromArrayCreatesCorrectStructureMinimalData(): void
    {
        $data = [
            'id' => 'conn_123',
            'user' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Business'],
            'user_chat_id' => '789012345678',
            'date' => 1700000000,
            'is_enabled' => true,
        ];
        $conn = BusinessConnection::fromArray($data);
        $this->assertSame('conn_123', $conn->id);
        $this->assertInstanceOf(User::class, $conn->user);
        $this->assertSame('789012345678', $conn->user_chat_id);
        $this->assertNull($conn->rights);
        $this->assertNull($conn->is_enabled);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'id' => 'conn_123',
            'user' => ['id' => '456', 'is_bot' => false, 'first_name' => 'Business'],
            'user_chat_id' => '789012345678',
            'date' => 1700000000,
            'rights' => [
                'can_reply' => true,
                'can_read_messages' => true,
                'can_delete_sent_messages' => true,
                'can_delete_all_messages' => true,
                'can_edit_name' => true,
                'can_edit_bio' => true,
                'can_edit_profile_photo' => true,
                'can_edit_username' => true,
                'can_change_gift_settings' => true,
                'can_view_gifts_and_stars' => true,
                'can_convert_gifts_to_stars' => true,
                'can_transfer_and_upgrade_gifts' => true,
                'can_transfer_stars' => true,
                'can_manage_stories' => true,
            ],
            'is_enabled' => true,
        ];
        $conn = BusinessConnection::fromArray($data);
        $this->assertSame($data, $conn->toArray());
    }
}
