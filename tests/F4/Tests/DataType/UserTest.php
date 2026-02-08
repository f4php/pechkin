<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('user_full.json');
        $user = User::fromArray($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('123456789', $user->id);
        $this->assertSame(false, $user->is_bot);
        $this->assertSame('John', $user->first_name);
        $this->assertSame('Doe', $user->last_name);
        $this->assertSame('johndoe', $user->username);
        $this->assertSame('en', $user->language_code);
        $this->assertSame(true, $user->is_premium);
        $this->assertSame(true, $user->added_to_attachment_menu);
        $this->assertSame(true, $user->can_join_groups);
        $this->assertSame(true, $user->can_read_all_group_messages);
        $this->assertSame(true, $user->supports_inline_queries);
        $this->assertSame(true, $user->can_connect_to_business);
        $this->assertSame(true, $user->has_main_web_app);
        $this->assertSame(true, $user->has_topics_enabled);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('user_minimal.json');
        $user = User::fromArray($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertNull($user->last_name);
        $this->assertNull($user->username);
        $this->assertNull($user->language_code);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('user_minimal.json');
        $user = User::fromArray($data);
        $this->assertEquals($data, $user->toArray());
    }
}
