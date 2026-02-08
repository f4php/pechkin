<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatPermissions;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatPermissionsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_permissions_full.json');
        $chatPermissions = ChatPermissions::fromArray($data);

        $this->assertInstanceOf(ChatPermissions::class, $chatPermissions);
        $this->assertSame(true, $chatPermissions->can_send_messages);
        $this->assertSame(true, $chatPermissions->can_send_audios);
        $this->assertSame(true, $chatPermissions->can_send_documents);
        $this->assertSame(true, $chatPermissions->can_send_photos);
        $this->assertSame(true, $chatPermissions->can_send_videos);
        $this->assertSame(true, $chatPermissions->can_send_video_notes);
        $this->assertSame(true, $chatPermissions->can_send_voice_notes);
        $this->assertSame(true, $chatPermissions->can_send_polls);
        $this->assertSame(true, $chatPermissions->can_send_other_messages);
        $this->assertSame(true, $chatPermissions->can_add_web_page_previews);
        $this->assertSame(true, $chatPermissions->can_change_info);
        $this->assertSame(true, $chatPermissions->can_invite_users);
        $this->assertSame(true, $chatPermissions->can_pin_messages);
        $this->assertSame(true, $chatPermissions->can_manage_topics);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('chat_permissions_minimal.json');
        $chatPermissions = ChatPermissions::fromArray($data);

        $this->assertInstanceOf(ChatPermissions::class, $chatPermissions);
        $this->assertNull($chatPermissions->can_send_messages);
        $this->assertNull($chatPermissions->can_send_audios);
        $this->assertNull($chatPermissions->can_send_documents);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_permissions_minimal.json');
        $chatPermissions = ChatPermissions::fromArray($data);
        $this->assertEquals($data, $chatPermissions->toArray());
    }
}
