<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\PollAnswer;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PollAnswerTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('poll_answer_full.json');
        $pollAnswer = PollAnswer::fromArray($data);

        $this->assertInstanceOf(PollAnswer::class, $pollAnswer);
        $this->assertNotEmpty($pollAnswer->option_ids);
        $this->assertInstanceOf(Chat::class, $pollAnswer->voter_chat);
        $this->assertInstanceOf(User::class, $pollAnswer->user);
        $this->assertSame('test_string', $pollAnswer->poll_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('poll_answer_minimal.json');
        $pollAnswer = PollAnswer::fromArray($data);

        $this->assertInstanceOf(PollAnswer::class, $pollAnswer);
        $this->assertNull($pollAnswer->voter_chat);
        $this->assertNull($pollAnswer->user);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('poll_answer_minimal.json');
        $pollAnswer = PollAnswer::fromArray($data);
        $this->assertEquals($data, $pollAnswer->toArray());
    }
}
