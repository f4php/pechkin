<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatMemberOwner;
use F4\Pechkin\DataType\User;

final class ChatMemberOwnerTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
            'is_anonymous' => false,
            'custom_title' => 'Owner',
        ];
        $member = ChatMemberOwner::fromArray($data);

        $this->assertInstanceOf(User::class, $member->user);
        $this->assertSame('123456789', $member->user->id);
        $this->assertFalse($member->is_anonymous);
        $this->assertSame('Owner', $member->custom_title);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'user' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
            'is_anonymous' => true,
        ];
        $member = ChatMemberOwner::fromArray($data);

        $this->assertTrue($member->is_anonymous);
        $this->assertNull($member->custom_title);
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
            'is_anonymous' => false,
            'custom_title' => 'Boss',
        ];
        $member = ChatMemberOwner::fromArray($data);
        $this->assertSame($data, $member->toArray());
    }
}
