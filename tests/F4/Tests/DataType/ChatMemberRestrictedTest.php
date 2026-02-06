<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatMemberRestricted;
use F4\Pechkin\DataType\User;

final class ChatMemberRestrictedTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'user' => ['id' => '123', 'is_bot' => false, 'first_name' => 'Restricted'],
            'is_member' => true,
            'can_send_messages' => false,
            'can_send_audios' => false,
            'can_send_documents' => false,
            'can_send_photos' => false,
            'can_send_videos' => false,
            'can_send_video_notes' => false,
            'can_send_voice_notes' => false,
            'can_send_polls' => false,
            'can_send_other_messages' => false,
            'can_add_web_page_previews' => false,
            'can_change_info' => false,
            'can_invite_users' => false,
            'can_pin_messages' => false,
            'can_manage_topics' => false,
            'until_date' => 1700000000,
        ];
        $member = ChatMemberRestricted::fromArray($data);
        $this->assertInstanceOf(User::class, $member->user);
        $this->assertTrue($member->is_member);
        $this->assertFalse($member->can_send_messages);
        $this->assertSame(1700000000, $member->until_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'user' => ['id' => '789', 'is_bot' => false, 'first_name' => 'Test'],
            'is_member' => true,
            'can_send_messages' => true,
            'can_send_audios' => false,
            'can_send_documents' => true,
            'can_send_photos' => true,
            'can_send_videos' => false,
            'can_send_video_notes' => false,
            'can_send_voice_notes' => true,
            'can_send_polls' => false,
            'can_send_other_messages' => true,
            'can_add_web_page_previews' => false,
            'can_change_info' => false,
            'can_invite_users' => true,
            'can_pin_messages' => false,
            'can_manage_topics' => false,
            'until_date' => 1800000000,
        ];
        $member = ChatMemberRestricted::fromArray($data);
        $this->assertSame($data, $member->toArray());
    }
}
