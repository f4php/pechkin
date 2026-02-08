<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\BusinessConnection;
use F4\Pechkin\DataType\BusinessMessagesDeleted;
use F4\Pechkin\DataType\CallbackQuery;
use F4\Pechkin\DataType\ChatBoostRemoved;
use F4\Pechkin\DataType\ChatBoostUpdated;
use F4\Pechkin\DataType\ChatJoinRequest;
use F4\Pechkin\DataType\ChatMemberUpdated;
use F4\Pechkin\DataType\ChosenInlineResult;
use F4\Pechkin\DataType\InlineQuery;
use F4\Pechkin\DataType\Message;
use F4\Pechkin\DataType\MessageReactionCountUpdated;
use F4\Pechkin\DataType\MessageReactionUpdated;
use F4\Pechkin\DataType\PaidMediaPurchased;
use F4\Pechkin\DataType\Poll;
use F4\Pechkin\DataType\PollAnswer;
use F4\Pechkin\DataType\PreCheckoutQuery;
use F4\Pechkin\DataType\ShippingQuery;
use F4\Pechkin\DataType\Update;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UpdateTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('update_full.json');
        $update = Update::fromArray($data);

        $this->assertInstanceOf(Update::class, $update);
        $this->assertSame(100000001, $update->update_id);
        $this->assertInstanceOf(Message::class, $update->message);
        // Update allows at most one payload field; fixture sets only 'message'
        $this->assertNull($update->edited_message);
        $this->assertNull($update->channel_post);
        $this->assertNull($update->edited_channel_post);
        $this->assertNull($update->business_connection);
        $this->assertNull($update->business_message);
        $this->assertNull($update->edited_business_message);
        $this->assertNull($update->deleted_business_messages);
        $this->assertNull($update->message_reaction);
        $this->assertNull($update->message_reaction_count);
        $this->assertNull($update->inline_query);
        $this->assertNull($update->chosen_inline_result);
        $this->assertNull($update->callback_query);
        $this->assertNull($update->shipping_query);
        $this->assertNull($update->pre_checkout_query);
        $this->assertNull($update->purchased_paid_media);
        $this->assertNull($update->poll);
        $this->assertNull($update->poll_answer);
        $this->assertNull($update->my_chat_member);
        $this->assertNull($update->chat_member);
        $this->assertNull($update->chat_join_request);
        $this->assertNull($update->chat_boost);
        $this->assertNull($update->removed_chat_boost);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('update_minimal.json');
        $update = Update::fromArray($data);

        $this->assertInstanceOf(Update::class, $update);
        $this->assertNull($update->message);
        $this->assertNull($update->edited_message);
        $this->assertNull($update->channel_post);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('update_minimal.json');
        $update = Update::fromArray($data);
        $this->assertEquals($data, $update->toArray());
    }
}
