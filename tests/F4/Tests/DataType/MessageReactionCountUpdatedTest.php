<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\MessageReactionCountUpdated;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class MessageReactionCountUpdatedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('message_reaction_count_updated_full.json');
        $messageReactionCountUpdated = MessageReactionCountUpdated::fromArray($data);

        $this->assertInstanceOf(MessageReactionCountUpdated::class, $messageReactionCountUpdated);
        $this->assertInstanceOf(Chat::class, $messageReactionCountUpdated->chat);
        $this->assertNotEmpty($messageReactionCountUpdated->reactions);
        $this->assertSame(42, $messageReactionCountUpdated->message_id);
        $this->assertSame(1700000000, $messageReactionCountUpdated->date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('message_reaction_count_updated_minimal.json');
        $messageReactionCountUpdated = MessageReactionCountUpdated::fromArray($data);
        $this->assertEquals($data, $messageReactionCountUpdated->toArray());
    }
}
