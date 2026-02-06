<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\CallbackQuery;
use F4\Pechkin\DataType\User;
use F4\Pechkin\DataType\Message;

final class CallbackQueryTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'id' => 'query123',
            'from' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
            'chat_instance' => 'instance123',
            'message' => [
                'message_id' => 42,
                'date' => 1700000000,
                'chat' => [
                    'id' => '-1001234567890',
                    'type' => 'supergroup',
                    'title' => 'Test',
                ],
            ],
            'data' => 'button_pressed',
        ];
        $query = CallbackQuery::fromArray($data);

        $this->assertSame('query123', $query->id);
        $this->assertInstanceOf(User::class, $query->from);
        $this->assertSame('instance123', $query->chat_instance);
        $this->assertInstanceOf(Message::class, $query->message);
        $this->assertSame('button_pressed', $query->data);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = [
            'id' => 'query123',
            'from' => [
                'id' => '123456789',
                'is_bot' => false,
                'first_name' => 'John',
            ],
            'chat_instance' => 'instance123',
        ];
        $query = CallbackQuery::fromArray($data);

        $this->assertSame('query123', $query->id);
        $this->assertNull($query->message);
        $this->assertNull($query->data);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'id' => 'query123',
            'from' => [
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
            'chat_instance' => 'instance123',
            'message' => null,
            'inline_message_id' => null,
            'data' => 'button_pressed',
            'game_short_name' => null,
        ];
        $query = CallbackQuery::fromArray($data);
        $this->assertSame($data, $query->toArray());
    }
}
