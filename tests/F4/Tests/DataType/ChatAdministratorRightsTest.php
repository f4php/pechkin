<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatAdministratorRights;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatAdministratorRightsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_administrator_rights_full.json');
        $chatAdministratorRights = ChatAdministratorRights::fromArray($data);

        $this->assertInstanceOf(ChatAdministratorRights::class, $chatAdministratorRights);
        $this->assertSame(true, $chatAdministratorRights->is_anonymous);
        $this->assertSame(true, $chatAdministratorRights->can_manage_chat);
        $this->assertSame(true, $chatAdministratorRights->can_delete_messages);
        $this->assertSame(true, $chatAdministratorRights->can_manage_video_chats);
        $this->assertSame(true, $chatAdministratorRights->can_restrict_members);
        $this->assertSame(true, $chatAdministratorRights->can_promote_members);
        $this->assertSame(true, $chatAdministratorRights->can_change_info);
        $this->assertSame(true, $chatAdministratorRights->can_invite_users);
        $this->assertSame(true, $chatAdministratorRights->can_post_stories);
        $this->assertSame(true, $chatAdministratorRights->can_edit_stories);
        $this->assertSame(true, $chatAdministratorRights->can_delete_stories);
        $this->assertSame(true, $chatAdministratorRights->can_post_messages);
        $this->assertSame(true, $chatAdministratorRights->can_edit_messages);
        $this->assertSame(true, $chatAdministratorRights->can_pin_messages);
        $this->assertSame(true, $chatAdministratorRights->can_manage_topics);
        $this->assertSame(true, $chatAdministratorRights->can_manage_direct_messages);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_administrator_rights_minimal.json');
        $chatAdministratorRights = ChatAdministratorRights::fromArray($data);

        $this->assertInstanceOf(ChatAdministratorRights::class, $chatAdministratorRights);
        $this->assertNull($chatAdministratorRights->can_post_messages);
        $this->assertNull($chatAdministratorRights->can_edit_messages);
        $this->assertNull($chatAdministratorRights->can_pin_messages);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_administrator_rights_minimal.json');
        $chatAdministratorRights = ChatAdministratorRights::fromArray($data);
        $this->assertEquals($data, $chatAdministratorRights->toArray());
    }
}
