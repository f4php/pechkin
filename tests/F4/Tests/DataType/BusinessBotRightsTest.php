<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\BusinessBotRights;

final class BusinessBotRightsTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'can_reply' => true,
            'can_read_messages' => true,
            'can_delete_sent_messages' => true,
            'can_delete_all_messages' => true,
            'can_edit_name' => true,
            'can_edit_bio' => true,
            'can_edit_profile_photo' => true,
            'can_edit_username' => true,
            'can_change_gift_settings' => true,
            'can_view_gifts_and_stars' => true,
            'can_convert_gifts_to_stars' => true,
            'can_transfer_and_upgrade_gifts' => true,
            'can_transfer_stars' => true,
            'can_manage_stories' => true,
        ];
        $rights = BusinessBotRights::fromArray($data);
        $this->assertTrue($rights->can_reply);
        $this->assertTrue($rights->can_read_messages);
        $this->assertTrue($rights->can_delete_sent_messages);
        $this->assertTrue($rights->can_delete_all_messages);
        $this->assertTrue($rights->can_edit_name);
        $this->assertTrue($rights->can_edit_bio);
        $this->assertTrue($rights->can_edit_profile_photo);
        $this->assertTrue($rights->can_edit_username);
        $this->assertTrue($rights->can_change_gift_settings);
        $this->assertTrue($rights->can_view_gifts_and_stars);
        $this->assertTrue($rights->can_convert_gifts_to_stars);
        $this->assertTrue($rights->can_transfer_and_upgrade_gifts);
        $this->assertTrue($rights->can_transfer_stars);
        $this->assertTrue($rights->can_manage_stories);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'can_reply' => true,
            'can_read_messages' => true,
            'can_delete_sent_messages' => true,
            'can_delete_all_messages' => true,
            'can_edit_name' => true,
            'can_edit_bio' => true,
            'can_edit_profile_photo' => true,
            'can_edit_username' => true,
            'can_change_gift_settings' => true,
            'can_view_gifts_and_stars' => true,
            'can_convert_gifts_to_stars' => true,
            'can_transfer_and_upgrade_gifts' => true,
            'can_transfer_stars' => true,
            'can_manage_stories' => true,
        ];
        $rights = BusinessBotRights::fromArray($data);
        $this->assertSame($data, $rights->toArray());
    }
}
