<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatMemberAdministrator;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatMemberAdministratorTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_member_administrator_full.json');
        $chatMemberAdministrator = ChatMemberAdministrator::fromArray($data);

        $this->assertInstanceOf(ChatMemberAdministrator::class, $chatMemberAdministrator);
        $this->assertInstanceOf(User::class, $chatMemberAdministrator->user);
        $this->assertSame(true, $chatMemberAdministrator->can_be_edited);
        $this->assertSame(true, $chatMemberAdministrator->is_anonymous);
        $this->assertSame(true, $chatMemberAdministrator->can_manage_chat);
        $this->assertSame(true, $chatMemberAdministrator->can_delete_messages);
        $this->assertSame(true, $chatMemberAdministrator->can_manage_video_chats);
        $this->assertSame(true, $chatMemberAdministrator->can_restrict_members);
        $this->assertSame(true, $chatMemberAdministrator->can_promote_members);
        $this->assertSame(true, $chatMemberAdministrator->can_change_info);
        $this->assertSame(true, $chatMemberAdministrator->can_invite_users);
        $this->assertSame(true, $chatMemberAdministrator->can_post_stories);
        $this->assertSame(true, $chatMemberAdministrator->can_edit_stories);
        $this->assertSame(true, $chatMemberAdministrator->can_delete_stories);
        $this->assertSame(true, $chatMemberAdministrator->can_post_messages);
        $this->assertSame(true, $chatMemberAdministrator->can_edit_messages);
        $this->assertSame(true, $chatMemberAdministrator->can_pin_messages);
        $this->assertSame(true, $chatMemberAdministrator->can_manage_topics);
        $this->assertSame(true, $chatMemberAdministrator->can_manage_direct_messages);
        $this->assertSame('Admin', $chatMemberAdministrator->custom_title);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_member_administrator_minimal.json');
        $chatMemberAdministrator = ChatMemberAdministrator::fromArray($data);

        $this->assertInstanceOf(ChatMemberAdministrator::class, $chatMemberAdministrator);
        $this->assertNull($chatMemberAdministrator->can_post_messages);
        $this->assertNull($chatMemberAdministrator->can_edit_messages);
        $this->assertNull($chatMemberAdministrator->can_pin_messages);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_member_administrator_minimal.json');
        $chatMemberAdministrator = ChatMemberAdministrator::fromArray($data);
        $this->assertEquals([...$data, 'status' => 'administrator'], $chatMemberAdministrator->toArray());
    }
}
