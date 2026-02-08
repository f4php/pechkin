<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BusinessBotRights;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class BusinessBotRightsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('business_bot_rights_full.json');
        $businessBotRights = BusinessBotRights::fromArray($data);

        $this->assertInstanceOf(BusinessBotRights::class, $businessBotRights);
        $this->assertSame(true, $businessBotRights->can_reply);
        $this->assertSame(true, $businessBotRights->can_read_messages);
        $this->assertSame(true, $businessBotRights->can_delete_sent_messages);
        $this->assertSame(true, $businessBotRights->can_delete_all_messages);
        $this->assertSame(true, $businessBotRights->can_edit_name);
        $this->assertSame(true, $businessBotRights->can_edit_bio);
        $this->assertSame(true, $businessBotRights->can_edit_profile_photo);
        $this->assertSame(true, $businessBotRights->can_edit_username);
        $this->assertSame(true, $businessBotRights->can_change_gift_settings);
        $this->assertSame(true, $businessBotRights->can_view_gifts_and_stars);
        $this->assertSame(true, $businessBotRights->can_convert_gifts_to_stars);
        $this->assertSame(true, $businessBotRights->can_transfer_and_upgrade_gifts);
        $this->assertSame(true, $businessBotRights->can_transfer_stars);
        $this->assertSame(true, $businessBotRights->can_manage_stories);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('business_bot_rights_minimal.json');
        $businessBotRights = BusinessBotRights::fromArray($data);

        $this->assertInstanceOf(BusinessBotRights::class, $businessBotRights);
        $this->assertNull($businessBotRights->can_reply);
        $this->assertNull($businessBotRights->can_read_messages);
        $this->assertNull($businessBotRights->can_delete_sent_messages);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('business_bot_rights_minimal.json');
        $businessBotRights = BusinessBotRights::fromArray($data);
        $this->assertEquals($data, $businessBotRights->toArray());
    }
}
