<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ReplyParameters;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ReplyParametersTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('reply_parameters_full.json');
        $replyParameters = ReplyParameters::fromArray($data);

        $this->assertInstanceOf(ReplyParameters::class, $replyParameters);
        $this->assertNotEmpty($replyParameters->quote_entities);
        $this->assertSame(42, $replyParameters->message_id);
        $this->assertSame(true, $replyParameters->allow_sending_without_reply);
        $this->assertSame('test_string', $replyParameters->quote);
        $this->assertSame('test_string', $replyParameters->quote_parse_mode);
        $this->assertSame(42, $replyParameters->quote_position);
        $this->assertSame(42, $replyParameters->checklist_task_id);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('reply_parameters_minimal.json');
        $replyParameters = ReplyParameters::fromArray($data);

        $this->assertInstanceOf(ReplyParameters::class, $replyParameters);
        $this->assertNull($replyParameters->chat_id);
        $this->assertNull($replyParameters->allow_sending_without_reply);
        $this->assertNull($replyParameters->quote);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('reply_parameters_minimal.json');
        $replyParameters = ReplyParameters::fromArray($data);
        $this->assertEquals($data, $replyParameters->toArray());
    }
}
