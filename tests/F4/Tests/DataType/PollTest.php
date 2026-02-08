<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Poll;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PollTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('poll_full.json');
        $poll = Poll::fromArray($data);

        $this->assertInstanceOf(Poll::class, $poll);
        $this->assertNotEmpty($poll->options);
        $this->assertNotEmpty($poll->question_entities);
        $this->assertNotEmpty($poll->explanation_entities);
        $this->assertSame('123456789', $poll->id);
        $this->assertSame('What is the answer?', $poll->question);
        $this->assertSame(42, $poll->total_voter_count);
        $this->assertSame(false, $poll->is_closed);
        $this->assertSame(true, $poll->is_anonymous);
        $this->assertSame('regular', $poll->type);
        $this->assertSame(false, $poll->allows_multiple_answers);
        $this->assertSame(0, $poll->correct_option_id);
        $this->assertSame('Because it is correct', $poll->explanation);
        $this->assertSame(60, $poll->open_period);
        $this->assertSame(1700086400, $poll->close_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('poll_minimal.json');
        $poll = Poll::fromArray($data);

        $this->assertInstanceOf(Poll::class, $poll);
        $this->assertNull($poll->question_entities);
        $this->assertNull($poll->correct_option_id);
        $this->assertNull($poll->explanation);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('poll_minimal.json');
        $poll = Poll::fromArray($data);
        $this->assertEquals($data, $poll->toArray());
    }
}
