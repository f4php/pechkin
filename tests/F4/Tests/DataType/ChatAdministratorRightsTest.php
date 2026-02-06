<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatAdministratorRights;

final class ChatAdministratorRightsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'is_anonymous' => false,
            'can_manage_chat' => true,
            'can_delete_messages' => true,
            'can_manage_video_chats' => true,
            'can_restrict_members' => true,
            'can_promote_members' => false,
            'can_change_info' => true,
            'can_invite_users' => true,
            'can_post_stories' => true,
            'can_edit_stories' => true,
            'can_delete_stories' => true,
            'can_post_messages' => true,
            'can_edit_messages' => true,
            'can_pin_messages' => true,
            'can_manage_topics' => true,
            'can_manage_direct_messages' => true,
        ];
        $rights = ChatAdministratorRights::fromArray($data);
        $this->assertFalse($rights->is_anonymous);
        $this->assertTrue($rights->can_manage_chat);
        $this->assertTrue($rights->can_delete_messages);
        $this->assertTrue($rights->can_manage_video_chats);
        $this->assertTrue($rights->can_restrict_members);
        $this->assertTrue($rights->can_promote_members);
        $this->assertTrue($rights->can_change_info);
        $this->assertTrue($rights->can_invite_users);
        $this->assertTrue($rights->can_post_stories);
        $this->assertTrue($rights->can_edit_stories);
        $this->assertTrue($rights->can_delete_stories);
        $this->assertTrue($rights->can_post_messages);
        $this->assertTrue($rights->can_edit_messages);
        $this->assertTrue($rights->can_pin_messages);
        $this->assertTrue($rights->can_manage_topics);
        $this->assertTrue($rights->can_manage_direct_messages);
    }

    public function testToArrayWithMinimalData(): void
    {
        $data = [
            'is_anonymous' => false,
            'can_manage_chat' => true,
            'can_delete_messages' => true,
            'can_manage_video_chats' => true,
            'can_restrict_members' => true,
            'can_promote_members' => false,
            'can_change_info' => true,
            'can_invite_users' => true,
            'can_post_stories' => true,
            'can_edit_stories' => true,
            'can_delete_stories' => true,
        ];
        $rights = ChatAdministratorRights::fromArray($data);
        $this->assertFalse($rights->is_anonymous);
        $this->assertTrue($rights->can_manage_chat);
        $this->assertTrue($rights->can_delete_messages);
        $this->assertTrue($rights->can_manage_video_chats);
        $this->assertTrue($rights->can_restrict_members);
        $this->assertTrue($rights->can_promote_members);
        $this->assertTrue($rights->can_change_info);
        $this->assertTrue($rights->can_invite_users);
        $this->assertTrue($rights->can_post_stories);
        $this->assertTrue($rights->can_edit_stories);
        $this->assertTrue($rights->can_delete_stories);
        $this->assertNull($rights->can_post_messages);
        $this->assertNull($rights->can_edit_messages);
        $this->assertNull($rights->can_pin_messages);
        $this->assertNull($rights->can_manage_topics);
        $this->assertNull($rights->can_manage_direct_messages);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'is_anonymous' => false,
            'can_manage_chat' => true,
            'can_delete_messages' => true,
            'can_manage_video_chats' => true,
            'can_restrict_members' => true,
            'can_promote_members' => true,
            'can_change_info' => true,
            'can_invite_users' => true,
        ];
        $rights = ChatAdministratorRights::fromArray($data);
        $this->assertSame($data, $rights->toArray());
    }
}
