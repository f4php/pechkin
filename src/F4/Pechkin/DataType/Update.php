<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

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
    ) {}
}
