<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BotFullInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BotFullInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('bot_full_info_full.json');
        $info = BotFullInfo::fromArray($data);

        $this->assertInstanceOf(BotFullInfo::class, $info);
        $this->assertSame('123456789', $info->id);
        $this->assertSame(true, $info->is_bot);
        $this->assertSame('TestBot', $info->first_name);
        $this->assertSame('test_bot', $info->username);
        $this->assertSame(['test_bot', 'test_bot_alias'], $info->active_usernames);
        $this->assertSame(true, $info->can_join_groups);
        $this->assertSame(false, $info->can_read_all_group_messages);
        $this->assertSame(true, $info->supports_inline_queries);
        $this->assertSame('Search...', $info->inline_query_placeholder);
        $this->assertSame(false, $info->needs_inline_query_location);
        $this->assertSame(true, $info->has_topics_enabled);
        $this->assertSame(true, $info->has_topic_sidebar);
        $this->assertSame(false, $info->supports_join_request_queries);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('bot_full_info_minimal.json');
        $info = BotFullInfo::fromArray($data);

        $this->assertInstanceOf(BotFullInfo::class, $info);
        $this->assertNull($info->username);
        $this->assertNull($info->active_usernames);
        $this->assertNull($info->inline_query_placeholder);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('bot_full_info_minimal.json');
        $info = BotFullInfo::fromArray($data);
        $this->assertEquals($data, $info->toArray());
    }
}
