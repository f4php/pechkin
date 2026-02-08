<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\MessageReactionUpdated;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageReactionUpdatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_reaction_updated_full.json');
        $messageReactionUpdated = MessageReactionUpdated::fromArray($data);

        $this->assertInstanceOf(MessageReactionUpdated::class, $messageReactionUpdated);
        $this->assertInstanceOf(Chat::class, $messageReactionUpdated->chat);
        $this->assertNotEmpty($messageReactionUpdated->old_reaction);
        $this->assertNotEmpty($messageReactionUpdated->new_reaction);
        $this->assertInstanceOf(User::class, $messageReactionUpdated->user);
        $this->assertInstanceOf(Chat::class, $messageReactionUpdated->actor_chat);
        $this->assertSame(42, $messageReactionUpdated->message_id);
        $this->assertSame(1700000000, $messageReactionUpdated->date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('message_reaction_updated_minimal.json');
        $messageReactionUpdated = MessageReactionUpdated::fromArray($data);

        $this->assertInstanceOf(MessageReactionUpdated::class, $messageReactionUpdated);
        $this->assertNull($messageReactionUpdated->user);
        $this->assertNull($messageReactionUpdated->actor_chat);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_reaction_updated_minimal.json');
        $messageReactionUpdated = MessageReactionUpdated::fromArray($data);
        $this->assertEquals($data, $messageReactionUpdated->toArray());
    }
}
