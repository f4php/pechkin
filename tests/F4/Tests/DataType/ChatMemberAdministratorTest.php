<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatMemberAdministrator;
use F4\Pechkin\DataType\User;

final class ChatMemberAdministratorTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'user' => ['id' => '123', 'is_bot' => false, 'first_name' => 'Admin'],
            'can_be_edited' => true,
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
            'custom_title' => 'custom title',
        ];
        $member = ChatMemberAdministrator::fromArray($data);
        $this->assertInstanceOf(User::class, $member->user);
        $this->assertSame('123', $member->user->id);
        $this->assertTrue($member->can_be_edited);
        $this->assertFalse($member->is_anonymous);
        $this->assertTrue($member->can_manage_chat);
        $this->assertTrue($member->can_delete_messages);
        $this->assertTrue($member->can_manage_video_chats);
        $this->assertTrue($member->can_restrict_members);
        $this->assertTrue($member->can_promote_members);
        $this->assertTrue($member->can_change_info);
        $this->assertTrue($member->can_invite_users);
        $this->assertTrue($member->can_post_stories);
        $this->assertTrue($member->can_edit_stories);
        $this->assertTrue($member->can_delete_stories);
        $this->assertTrue($member->can_post_messages);
        $this->assertTrue($member->can_edit_messages);
        $this->assertTrue($member->can_pin_messages);
        $this->assertTrue($member->can_manage_topics);
        $this->assertTrue($member->can_manage_direct_messages);
        $this->assertSame('custom title', $member->custom_title);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'user' => ['id' => '123', 'is_bot' => false, 'first_name' => 'Admin'],
            'can_be_edited' => true,
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
        $member = ChatMemberAdministrator::fromArray($data);
        $this->assertInstanceOf(User::class, $member->user);
        $this->assertSame('123', $member->user->id);
        $this->assertTrue($member->can_be_edited);
        $this->assertFalse($member->is_anonymous);
        $this->assertTrue($member->can_manage_chat);
        $this->assertTrue($member->can_delete_messages);
        $this->assertTrue($member->can_manage_video_chats);
        $this->assertTrue($member->can_restrict_members);
        $this->assertTrue($member->can_promote_members);
        $this->assertTrue($member->can_change_info);
        $this->assertTrue($member->can_invite_users);
        $this->assertTrue($member->can_post_stories);
        $this->assertTrue($member->can_edit_stories);
        $this->assertTrue($member->can_delete_stories);
        $this->assertNull($member->can_post_messages);
        $this->assertNull($member->can_edit_messages);
        $this->assertNull($member->can_pin_messages);
        $this->assertNull($member->can_manage_topics);
        $this->assertNull($member->can_manage_direct_messages);
        $this->assertNull($member->custom_title);
    }


    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'user' => ['id' => '123', 'is_bot' => false, 'first_name' => 'Admin'],
            'can_be_edited' => true,
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
            'custom_title' => 'custom title',
        ];
        $member = ChatMemberAdministrator::fromArray($data);
        $this->assertSame($data, $member->toArray());
    }
}
