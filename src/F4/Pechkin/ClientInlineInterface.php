<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Pechkin\DataType\{
    InlineQueryResult,
    InlineQueryResultsButton,
    PreparedInlineMessage,
    SentWebAppMessage,
};

// Documentation: https://core.telegram.org/bots/api

interface ClientInlineInterface
{
    /**
     * Use this method to send answers to an inline query.
     * @param string $inline_query_id Unique identifier for the answered query
     * @param InlineQueryResult[] $results An array of results for the inline query
     * @param int|null $cache_time The maximum amount of time in seconds that the result of the inline query may be cached on the server
     * @param bool|null $is_personal Pass True if results may be cached on the server side only for the user that sent the query
     * @param string|null $next_offset Pass the offset that a client should send in the next query with the same text to receive more results
     * @param InlineQueryResultsButton|null $button A JSON-serialized object describing a button to be shown above inline query results
     * @return bool Returns True on success
     */
    public function answerInlineQuery(
        string $inline_query_id,
        array $results,
        ?int $cache_time = null,
        ?bool $is_personal = null,
        ?string $next_offset = null,
        ?InlineQueryResultsButton $button = null,
    ): bool;

    /**
     * Use this method to set the result of an interaction with a Web App and send a corresponding message on behalf of the user to the chat from which the query originated.
     * @param string $web_app_query_id Unique identifier for the query to be answered
     * @param InlineQueryResult $result A JSON-serialized object describing the message to be sent
     * @return SentWebAppMessage Returns a SentWebAppMessage object on success
     */
    public function answerWebAppQuery(
        string $web_app_query_id,
        InlineQueryResult $result,
    ): SentWebAppMessage;

    /**
     * Stores a message that can be sent by a user of a Mini App.
     * @param int $user_id Unique identifier of the target user that can use the prepared message
     * @param InlineQueryResult $result A JSON-serialized object describing the message to be sent
     * @param bool|null $allow_user_chats Pass True if the message can be sent to private chats with users
     * @param bool|null $allow_bot_chats Pass True if the message can be sent to private chats with bots
     * @param bool|null $allow_group_chats Pass True if the message can be sent to group and supergroup chats
     * @param bool|null $allow_channel_chats Pass True if the message can be sent to channel chats
     * @return PreparedInlineMessage Returns a PreparedInlineMessage object on success
     */
    public function savePreparedInlineMessage(
        int $user_id,
        InlineQueryResult $result,
        ?bool $allow_user_chats = null,
        ?bool $allow_bot_chats = null,
        ?bool $allow_group_chats = null,
        ?bool $allow_channel_chats = null,
    ): PreparedInlineMessage;

}
