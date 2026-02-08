<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    BusinessConnection,
    BusinessMessagesDeleted,
    CallbackQuery,
    ChatBoostRemoved,
    ChatBoostUpdated,
    ChatJoinRequest,
    ChatMemberUpdated,
    ChosenInlineResult,
    InlineQuery,
    Message,
    MessageReactionCountUpdated,
    MessageReactionUpdated,
    PaidMediaPurchased,
    Poll,
    PollAnswer,
    PreCheckoutQuery,
    ShippingQuery,
};

use function 
    array_filter,
    count
;

readonly class Update extends AbstractDataType
{
    public function __construct(
        public readonly int $update_id,
        public readonly ?Message $message = null,
        public readonly ?Message $edited_message = null,
        public readonly ?Message $channel_post = null,
        public readonly ?Message $edited_channel_post = null,
        public readonly ?BusinessConnection $business_connection = null,
        public readonly ?Message $business_message = null,
        public readonly ?Message $edited_business_message = null,
        public readonly ?BusinessMessagesDeleted $deleted_business_messages = null,
        public readonly ?MessageReactionUpdated $message_reaction = null,
        public readonly ?MessageReactionCountUpdated $message_reaction_count = null,
        public readonly ?InlineQuery $inline_query = null,
        public readonly ?ChosenInlineResult $chosen_inline_result = null,
        public readonly ?CallbackQuery $callback_query = null,
        public readonly ?ShippingQuery $shipping_query = null,
        public readonly ?PreCheckoutQuery $pre_checkout_query = null,
        public readonly ?PaidMediaPurchased $purchased_paid_media = null,
        public readonly ?Poll $poll = null,
        public readonly ?PollAnswer $poll_answer = null,
        public readonly ?ChatMemberUpdated $my_chat_member = null,
        public readonly ?ChatMemberUpdated $chat_member = null,
        public readonly ?ChatJoinRequest $chat_join_request = null,
        public readonly ?ChatBoostUpdated $chat_boost = null,
        public readonly ?ChatBoostRemoved $removed_chat_boost = null,
    ) {
        if (1 < count(array_filter([
            $this->message,
            $this->edited_message,
            $this->channel_post,
            $this->edited_channel_post,
            $this->business_connection,
            $this->business_message,
            $this->edited_business_message,
            $this->deleted_business_messages,
            $this->message_reaction,
            $this->message_reaction_count,
            $this->inline_query,
            $this->chosen_inline_result,
            $this->callback_query,
            $this->shipping_query,
            $this->pre_checkout_query,
            $this->purchased_paid_media,
            $this->poll,
            $this->poll_answer,
            $this->my_chat_member,
            $this->chat_member,
            $this->chat_join_request,
            $this->chat_boost,
            $this->removed_chat_boost,
        ]))) {
            throw new InvalidArgumentException('At most one update payload field may be set.');
        }
    }
}
