<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChatMemberRestricted;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChatMemberRestrictedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('chat_member_restricted_full.json');
        $chatMemberRestricted = ChatMemberRestricted::fromArray($data);
        $this->assertInstanceOf(ChatMemberRestricted::class, $chatMemberRestricted);
        $this->assertInstanceOf(User::class, $chatMemberRestricted->user);
        $this->assertSame(true, $chatMemberRestricted->is_member);
        $this->assertSame(true, $chatMemberRestricted->can_send_messages);
        $this->assertSame(true, $chatMemberRestricted->can_send_audios);
        $this->assertSame(true, $chatMemberRestricted->can_send_documents);
        $this->assertSame(true, $chatMemberRestricted->can_send_photos);
        $this->assertSame(true, $chatMemberRestricted->can_send_videos);
        $this->assertSame(true, $chatMemberRestricted->can_send_video_notes);
        $this->assertSame(true, $chatMemberRestricted->can_send_voice_notes);
        $this->assertSame(true, $chatMemberRestricted->can_send_polls);
        $this->assertSame(true, $chatMemberRestricted->can_send_other_messages);
        $this->assertSame(true, $chatMemberRestricted->can_add_web_page_previews);
        $this->assertSame(true, $chatMemberRestricted->can_change_info);
        $this->assertSame(true, $chatMemberRestricted->can_invite_users);
        $this->assertSame(true, $chatMemberRestricted->can_pin_messages);
        $this->assertSame(true, $chatMemberRestricted->can_manage_topics);
        $this->assertSame(1700172800, $chatMemberRestricted->until_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('chat_member_restricted_minimal.json');
        $chatMemberRestricted = ChatMemberRestricted::fromArray($data);
        $this->assertEquals([...$data, 'status' => 'restricted'], $chatMemberRestricted->toArray());
    }
}
