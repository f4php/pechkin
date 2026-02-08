<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\SuggestedPostDeclined;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuggestedPostDeclinedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('suggested_post_declined_full.json');
        $suggestedPostDeclined = SuggestedPostDeclined::fromArray($data);

        $this->assertInstanceOf(SuggestedPostDeclined::class, $suggestedPostDeclined);
        $this->assertInstanceOf(Message::class, $suggestedPostDeclined->suggested_post_message);
        $this->assertSame('test_string', $suggestedPostDeclined->comment);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('suggested_post_declined_minimal.json');
        $suggestedPostDeclined = SuggestedPostDeclined::fromArray($data);

        $this->assertInstanceOf(SuggestedPostDeclined::class, $suggestedPostDeclined);
        $this->assertNull($suggestedPostDeclined->suggested_post_message);
        $this->assertNull($suggestedPostDeclined->comment);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('suggested_post_declined_minimal.json');
        $suggestedPostDeclined = SuggestedPostDeclined::fromArray($data);
        $this->assertEquals($data, $suggestedPostDeclined->toArray());
    }
}
