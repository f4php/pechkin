<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PreparedInlineMessage;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PreparedInlineMessageTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('prepared_inline_message_full.json');
        $preparedInlineMessage = PreparedInlineMessage::fromArray($data);

        $this->assertInstanceOf(PreparedInlineMessage::class, $preparedInlineMessage);
        $this->assertSame('123456789', $preparedInlineMessage->id);
        $this->assertSame(1700172800, $preparedInlineMessage->expiration_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('prepared_inline_message_minimal.json');
        $preparedInlineMessage = PreparedInlineMessage::fromArray($data);
        $this->assertEquals($data, $preparedInlineMessage->toArray());
    }
}
