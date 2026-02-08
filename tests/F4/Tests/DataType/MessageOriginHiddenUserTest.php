<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\MessageOriginHiddenUser;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageOriginHiddenUserTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_origin_hidden_user_full.json');
        $messageOriginHiddenUser = MessageOriginHiddenUser::fromArray($data);

        $this->assertInstanceOf(MessageOriginHiddenUser::class, $messageOriginHiddenUser);
        $this->assertSame(1700000000, $messageOriginHiddenUser->date);
        $this->assertSame('sender_user', $messageOriginHiddenUser->sender_user_name);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_origin_hidden_user_minimal.json');
        $messageOriginHiddenUser = MessageOriginHiddenUser::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'hidden_user'], $messageOriginHiddenUser->toArray());
    }
}
