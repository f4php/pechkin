<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\AffiliateInfo;
use F4\Pechkin\DataType\User;
use F4\Pechkin\DataType\Chat;

final class AffiliateInfoTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'affiliate_user' => ['id' => '123', 'is_bot' => false, 'first_name' => 'Affiliate'],
            'affiliate_chat' => ['id' => '456', 'type' => 'private'],
            'commission_per_mille' => 100,
            'amount' => 500,
            'nanostar_amount' => -100,
        ];
        $info = AffiliateInfo::fromArray($data);
        $this->assertInstanceOf(User::class, $info->affiliate_user);
        $this->assertInstanceOf(Chat::class, $info->affiliate_chat);
        $this->assertSame(100, $info->commission_per_mille);
        $this->assertSame(500, $info->amount);
        $this->assertSame(-100, $info->nanostar_amount);
    }

    public function testToArrayCreatedCorrectStructureMinimalData(): void
    {
        $data = [
            'commission_per_mille' => 50,
            'amount' => 1000,
            'nanostar_amount' => -100,
        ];
        $info = AffiliateInfo::fromArray($data);
        $this->assertNull($info->affiliate_user);
        $this->assertNull($info->affiliate_chat);
        $this->assertSame(100, $info->commission_per_mille);
        $this->assertSame(500, $info->amount);
        $this->assertSame(-100, $info->nanostar_amount);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'affiliate_user' => [
                'id' => '123',
                'is_bot' => false,
                'first_name' => 'Test',
                'last_name' => 'Doe',
                'username' => 'johndoe',
                'language_code' => 'en',
                'is_premium' => true,
                'added_to_attachment_menu' => null,
                'can_join_groups' => null,
                'can_read_all_group_messages' => null,
                'supports_inline_queries' => null,
                'can_connect_to_business' => null,
                'has_main_web_app' => null,
                'has_topics_enabled' => null,
            ],
            'affiliate_chat' => [
                'id' => '456', 
                'type' => 'supergroup',
                'title' => 'Test Group',
                'username' => 'testgroup',
                'first_name' => null,
                'last_name' => null,
                'is_forum' => true,
            ],
            'commission_per_mille' => 200,
            'amount' => 750,
            'nanostar_amount' => -100,
        ];
        $info = AffiliateInfo::fromArray($data);
        $this->assertSame($data, $info->toArray());
    }
}
