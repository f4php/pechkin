<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ForceReply;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ForceReplyTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('force_reply_full.json');
        $forceReply = ForceReply::fromArray($data);

        $this->assertInstanceOf(ForceReply::class, $forceReply);
        $this->assertSame(true, $forceReply->force_reply);
        $this->assertSame('Type here...', $forceReply->input_field_placeholder);
        $this->assertSame(false, $forceReply->selective);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('force_reply_minimal.json');
        $forceReply = ForceReply::fromArray($data);

        $this->assertInstanceOf(ForceReply::class, $forceReply);
        $this->assertNull($forceReply->input_field_placeholder);
        $this->assertNull($forceReply->selective);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('force_reply_minimal.json');
        $forceReply = ForceReply::fromArray($data);
        $this->assertEquals($data, $forceReply->toArray());
    }
}
