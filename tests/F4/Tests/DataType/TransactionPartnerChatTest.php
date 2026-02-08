<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\Gift;
use F4\Pechkin\DataType\TransactionPartnerChat;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class TransactionPartnerChatTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('transaction_partner_chat_full.json');
        $transactionPartnerChat = TransactionPartnerChat::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerChat::class, $transactionPartnerChat);
        $this->assertInstanceOf(Chat::class, $transactionPartnerChat->chat);
        $this->assertInstanceOf(Gift::class, $transactionPartnerChat->gift);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('transaction_partner_chat_minimal.json');
        $transactionPartnerChat = TransactionPartnerChat::fromArray($data);

        $this->assertInstanceOf(TransactionPartnerChat::class, $transactionPartnerChat);
        $this->assertNull($transactionPartnerChat->gift);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('transaction_partner_chat_minimal.json');
        $transactionPartnerChat = TransactionPartnerChat::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'chat'], $transactionPartnerChat->toArray());
    }
}
