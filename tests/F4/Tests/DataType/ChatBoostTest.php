<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\ChatBoost;
use F4\Pechkin\DataType\ChatBoostSource;
use F4\Pechkin\DataType\ChatBoostSourcePremium;

final class ChatBoostTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'boost_id' => 'boost123',
            'add_date' => 1700000000,
            'expiration_date' => 1702592000,
            'source' => [
                'type' => 'premium',
                'user' => [
                    'id' => '123456789',
                    'is_bot' => false,
                    'first_name' => 'John',
                ],
            ],
        ];
        $boost = ChatBoost::fromArray($data);

        $this->assertSame('boost123', $boost->boost_id);
        $this->assertSame(1700000000, $boost->add_date);
        $this->assertSame(1702592000, $boost->expiration_date);
        $this->assertInstanceOf(ChatBoostSourcePremium::class, $boost->source);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'boost_id' => 'boost123',
            'add_date' => 1700000000,
            'expiration_date' => 1702592000,
            'source' => [
                'type' => 'premium',
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
            ],
        ];
        $boost = ChatBoost::fromArray($data);
        $this->assertSame($data, $boost->toArray());
    }
}
