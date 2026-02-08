<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\VideoChatParticipantsInvited;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class VideoChatParticipantsInvitedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('video_chat_participants_invited_full.json');
        $videoChatParticipantsInvited = VideoChatParticipantsInvited::fromArray($data);

        $this->assertInstanceOf(VideoChatParticipantsInvited::class, $videoChatParticipantsInvited);
        $this->assertNotEmpty($videoChatParticipantsInvited->users);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('video_chat_participants_invited_minimal.json');
        $videoChatParticipantsInvited = VideoChatParticipantsInvited::fromArray($data);
        $this->assertEquals($data, $videoChatParticipantsInvited->toArray());
    }
}
