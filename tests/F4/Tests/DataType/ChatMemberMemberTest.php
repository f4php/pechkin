<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatMemberMember;
use F4\Pechkin\DataType\User;

final class ChatMemberMemberTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
            'until_date' => 1700000000,
        ];
        $member = ChatMemberMember::fromArray($data);

        $this->assertInstanceOf(User::class, $member->user);
        $this->assertSame('123456789', $member->user->id);
        $this->assertSame(1700000000, $member->until_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
        ];
        $member = ChatMemberMember::fromArray($data);

        $this->assertInstanceOf(User::class, $member->user);
        $this->assertNull($member->until_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
                'last_name' => null,
                'username' => null,
                'language_code' => null,
                'is_premium' => null,
                'added_to_attachment_menu' => null,
                'can_join_groups' => null,
                'can_read_all_group_messages' => null,
                'supports_inline_queries' => null,
                'can_connect_to_business' => null,
                'has_main_web_app' => null,
                'has_topics_enabled' => null,
            ],
            'until_date' => null,
        ];
        $member = ChatMemberMember::fromArray($data);
        $this->assertSame($data, $member->toArray());
    }
}
