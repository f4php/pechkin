<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InlineQueryResultsButton;
use F4\Pechkin\DataType\WebAppInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InlineQueryResultsButtonTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('inline_query_results_button_full.json');
        $inlineQueryResultsButton = InlineQueryResultsButton::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultsButton::class, $inlineQueryResultsButton);
        $this->assertInstanceOf(WebAppInfo::class, $inlineQueryResultsButton->web_app);
        $this->assertNull($inlineQueryResultsButton->start_parameter);
        $this->assertSame('Hello, World!', $inlineQueryResultsButton->text);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('inline_query_results_button_minimal.json');
        $inlineQueryResultsButton = InlineQueryResultsButton::fromArray($data);

        $this->assertInstanceOf(InlineQueryResultsButton::class, $inlineQueryResultsButton);
        // XOR constraint: exactly one of web_app or start_parameter must be set
        $this->assertNull($inlineQueryResultsButton->web_app);
        $this->assertSame('test_start', $inlineQueryResultsButton->start_parameter);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('inline_query_results_button_minimal.json');
        $inlineQueryResultsButton = InlineQueryResultsButton::fromArray($data);
        $this->assertEquals($data, $inlineQueryResultsButton->toArray());
    }
}
