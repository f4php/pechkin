<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Pechkin\DataType\{
    AcceptedGiftTypes,
    BotCommand,
    BotCommandScope,
    BotDescription,
    BotName,
    BotShortDescription,
    BusinessConnection,
    ChatAdministratorRights,
    ChatFullInfo,
    ChatInviteLink,
    ChatMember,
    ChatPermissions,
    File,
    ForceReply,
    ForumTopic,
    GameHighScore,
    Gifts,
    InlineKeyboardMarkup,
    InlineQueryResult,
    InlineQueryResultsButton,
    InputChecklist,
    InputFile,
    InputMedia,
    InputPaidMedia,
    InputProfilePhoto,
    InputSticker,
    InputStoryContent,
    LabeledPrice,
    LinkPreviewOptions,
    MaskPosition,
    MenuButton,
    Message,
    MessageEntity,
    MessageId,
    OwnedGifts,
    PassportElementError,
    Poll,
    PreparedInlineMessage,
    ReactionType,
    ReplyKeyboardMarkup,
    ReplyKeyboardRemove,
    ReplyParameters,
    SentWebAppMessage,
    ShippingOption,
    StarAmount,
    StarTransactions,
    Sticker,
    StickerSet,
    Story,
    StoryArea,
    SuggestedPostParameters,
    Update,
    User,
    UserChatBoosts,
    UserProfilePhotos,
    WebHookInfo,
};

// Documentation: https://core.telegram.org/bots/api

interface ClientInterface
{
    /**
     * Adds a new sticker to a set created by the bot.
     * @param int $user_id User identifier of the sticker set owner
     * @param string $name Sticker set name
     * @param InputSticker $sticker A JSON-serialized object with information about the added sticker
     * @return bool Returns True on success
     */
    public function addStickerToSet(
        int $user_id,
        string $name,
        InputSticker $sticker,
    ): bool;

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     * @param string $callback_query_id Unique identifier for the query to be answered
     * @param string|null $text Text of the notification. If not specified, nothing will be shown to the user
     * @param bool|null $show_alert If True, an alert will be shown by the client instead of a notification
     * @param string|null $url URL that will be opened by the user's client
     * @param int|null $cache_time The maximum amount of time in seconds that the result of the callback query may be cached client-side
     * @return bool Returns True on success
     */
    public function answerCallbackQuery(
        string $callback_query_id,
        ?string $text = null,
        ?bool $show_alert = null,
        ?string $url = null,
        ?int $cache_time = null,
    ): bool;

    /**
     * Use this method to reply to pre-checkout queries.
     * @param string $pre_checkout_query_id Unique identifier for the query to be answered
     * @param bool $ok Specify True if everything is alright and the bot is ready to proceed with the order
     * @param string|null $error_message Error message in human readable form if the query was not successful
     * @return bool Returns True on success
     */
    public function answerPreCheckoutQuery(
        string $pre_checkout_query_id,
        bool $ok,
        ?string $error_message = null,
    ): bool;

    /**
     * Use this method to reply to shipping queries.
     * @param string $shipping_query_id Unique identifier for the query to be answered
     * @param bool $ok Pass True if delivery to the specified address is possible
     * @param ShippingOption[]|null $shipping_options A list of available shipping options
     * @param string|null $error_message Error message in human readable form if delivery is not possible
     * @return bool Returns True on success
     */
    public function answerShippingQuery(
        string $shipping_query_id,
        bool $ok,
        ?array $shipping_options = null,
        ?string $error_message = null,
    ): bool;

    /**
     * Use this method to approve a chat join request.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $user_id Unique identifier of the target user
     * @return bool Returns True on success
     */
    public function approveChatJoinRequest(
        int|string $chat_id,
        int $user_id,
    ): bool;

    /**
     * Approves a suggested post in a channel managed by the bot.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $message_id Identifier of the suggested post to approve
     * @param int|null $send_date Point in time (Unix timestamp) when the post will be sent
     * @return bool Returns True on success
     */
    public function approveSuggestedPost(
        int|string $chat_id,
        int $message_id,
        ?int $send_date = null,
    ): bool;

    /**
     * Use this method to ban a user in a group, a supergroup or a channel.
     * @param int|string $chat_id Unique identifier for the target group or username of the target supergroup or channel
     * @param int $user_id Unique identifier of the target user
     * @param int|null $until_date Date when the user will be unbanned; Unix time
     * @param bool|null $revoke_messages Pass True to delete all messages from the chat for the user that is being removed
     * @return bool Returns True on success
     */
    public function banChatMember(
        int|string $chat_id,
        int $user_id,
        ?int $until_date = null,
        ?bool $revoke_messages = null,
    ): bool;

    /**
     * Use this method to ban a channel chat in a supergroup or a channel.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $sender_chat_id Unique identifier of the target sender chat
     * @return bool Returns True on success
     */
    public function banChatSenderChat(
        int|string $chat_id,
        int $sender_chat_id,
    ): bool;

    /**
     * Use this method to close the bot instance before moving it from one local server to another.
     * @return bool Returns True on success
     */
    public function close(): bool;

    /**
     * Use this method to close an open topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     * @return bool Returns True on success
     */
    public function closeForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): bool;

    /**
     * Use this method to close an open 'General' topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @return bool Returns True on success
     */
    public function closeGeneralForumTopic(
        int|string $chat_id,
    ): bool;

    /**
     * Converts a given regular gift to Telegram Stars.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string $owned_gift_id Unique identifier of the regular gift that should be converted to Telegram Stars
     * @return bool Returns True on success
     */
    public function convertGiftToStars(
        string $business_connection_id,
        string $owned_gift_id,
    ): bool;

    /**
     * Use this method to copy messages of any kind.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent
     * @param int $message_id Message identifier in the chat specified in from_chat_id
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param int|null $video_start_timestamp New start timestamp for the copied video in seconds
     * @param string|null $caption New caption for media
     * @param string|null $parse_mode Mode for parsing entities in the new caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the new caption
     * @param bool|null $show_caption_above_media Pass True if the caption must be shown above the message media
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return MessageId Returns the MessageId of the sent message on success
     */
    public function copyMessage(
        int|string $chat_id,
        int|string $from_chat_id,
        int $message_id,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?int $video_start_timestamp = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): MessageId;

    /**
     * Use this method to copy messages of any kind. Returns an array of MessageId.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int|string $from_chat_id Unique identifier for the chat where the original messages were sent
     * @param int[] $message_ids A list of 1-100 identifiers of messages in the chat from_chat_id to copy
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param bool|null $disable_notification Sends the messages silently
     * @param bool|null $protect_content Protects the contents of the sent messages from forwarding and saving
     * @param bool|null $remove_caption Pass True to copy the messages without their captions
     * @return MessageId[] Returns an array of MessageId of the sent messages on success
     */
    public function copyMessages(
        int|string $chat_id,
        int|string $from_chat_id,
        array $message_ids,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $remove_caption = null,
    ): array;

    /**
     * Use this method to create an additional invite link for a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string|null $name Invite link name
     * @param int|null $expire_date Point in time (Unix timestamp) when the link will expire
     * @param int|null $member_limit Maximum number of users that can be members of the chat simultaneously
     * @param bool|null $creates_join_request True, if users joining the chat via the link need to be approved
     * @return ChatInviteLink Returns the new invite link as ChatInviteLink object
     */
    public function createChatInviteLink(
        int|string $chat_id,
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        ?bool $creates_join_request = null,
    ): ChatInviteLink;

    /**
     * Use this method to create a subscription invite link for a channel chat.
     * @param int|string $chat_id Unique identifier for the target channel chat or username of the target channel
     * @param int $subscription_period The number of seconds the subscription will be active for before the next payment
     * @param int $subscription_price The amount of Telegram Stars a user must pay initially and after each subsequent subscription period
     * @param string|null $name Invite link name
     * @return ChatInviteLink Returns the new invite link as a ChatInviteLink object
     */
    public function createChatSubscriptionInviteLink(
        int|string $chat_id,
        int $subscription_period,
        int $subscription_price,
        ?string $name = null,
    ): ChatInviteLink;

    /**
     * Use this method to create a link for an invoice.
     * @param string $title Product name
     * @param string $description Product description
     * @param string $payload Bot-defined invoice payload
     * @param string $currency Three-letter ISO 4217 currency code or "XTR" for payments in Telegram Stars
     * @param LabeledPrice[] $prices Price breakdown, a list of components
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param string|null $provider_token Payment provider token
     * @param int|null $subscription_period The number of seconds the subscription will be active for
     * @param int|null $max_tip_amount The maximum accepted amount for tips in the smallest units of the currency
     * @param int[]|null $suggested_tip_amounts A list of suggested amounts of tips in the smallest units of the currency
     * @param string|null $provider_data JSON-serialized data about the invoice, which will be shared with the payment provider
     * @param string|null $photo_url URL of the product photo for the invoice
     * @param int|null $photo_size Photo size in bytes
     * @param int|null $photo_width Photo width
     * @param int|null $photo_height Photo height
     * @param bool|null $need_name Pass True if you require the user's full name to complete the order
     * @param bool|null $need_phone_number Pass True if you require the user's phone number to complete the order
     * @param bool|null $need_email Pass True if you require the user's email address to complete the order
     * @param bool|null $need_shipping_address Pass True if you require the user's shipping address to complete the order
     * @param bool|null $send_phone_number_to_provider Pass True if the user's phone number should be sent to the provider
     * @param bool|null $send_email_to_provider Pass True if the user's email address should be sent to the provider
     * @param bool|null $is_flexible Pass True if the final price depends on the shipping method
     * @return string Returns the created invoice link as String on success
     */
    public function createInvoiceLink(
        string $title,
        string $description,
        string $payload,
        string $currency,
        array $prices,
        ?string $business_connection_id = null,
        ?string $provider_token = null,
        ?int $subscription_period = null,
        ?int $max_tip_amount = null,
        ?array $suggested_tip_amounts = null,
        ?string $provider_data = null,
        ?string $photo_url = null,
        ?int $photo_size = null,
        ?int $photo_width = null,
        ?int $photo_height = null,
        ?bool $need_name = null,
        ?bool $need_phone_number = null,
        ?bool $need_email = null,
        ?bool $need_shipping_address = null,
        ?bool $send_phone_number_to_provider = null,
        ?bool $send_email_to_provider = null,
        ?bool $is_flexible = null,
    ): string;

    /**
     * Use this method to create a new sticker set owned by a user.
     * @param int $user_id User identifier of created sticker set owner
     * @param string $name Short name of sticker set
     * @param string $title Sticker set title, 1-64 characters
     * @param InputSticker[] $stickers A list of 1-50 initial stickers to be added to the sticker set
     * @param string|null $sticker_type Type of stickers in the set
     * @param bool|null $needs_repainting Pass True if stickers in the sticker set must be repainted to the color of text
     * @return bool Returns True on success
     */
    public function createNewStickerSet(
        int $user_id,
        string $name,
        string $title,
        array $stickers,
        ?string $sticker_type = null,
        ?bool $needs_repainting = null,
    ): bool;

    /**
     * Use this method to create a topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param string $name Topic name, 1-128 characters
     * @param int|null $icon_color Color of the topic icon in RGB format
     * @param string|null $icon_custom_emoji_id Unique identifier of the custom emoji shown as the topic icon
     * @return ForumTopic Returns information about the created topic as a ForumTopic object
     */
    public function createForumTopic(
        int|string $chat_id,
        string $name,
        ?int $icon_color = null,
        ?string $icon_custom_emoji_id = null,
    ): ForumTopic;

    /**
     * Use this method to decline a chat join request.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $user_id Unique identifier of the target user
     * @return bool Returns True on success
     */
    public function declineChatJoinRequest(
        int|string $chat_id,
        int $user_id,
    ): bool;

    /**
     * Declines a suggested post in a channel managed by the bot.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $message_id Identifier of the suggested post to decline
     * @param string|null $comment Comment to show to the post author
     * @return bool Returns True on success
     */
    public function declineSuggestedPost(
        int|string $chat_id,
        int $message_id,
        ?string $comment = null,
    ): bool;

    /**
     * Use this method to delete messages on behalf of a business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int[] $message_ids A list of 1-100 identifiers of messages to delete
     * @return bool Returns True on success
     */
    public function deleteBusinessMessages(
        string $business_connection_id,
        array $message_ids,
    ): bool;

    /**
     * Use this method to delete a chat photo.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @return bool Returns True on success
     */
    public function deleteChatPhoto(
        int|string $chat_id,
    ): bool;

    /**
     * Use this method to delete a group sticker set from a supergroup.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @return bool Returns True on success
     */
    public function deleteChatStickerSet(
        int|string $chat_id,
    ): bool;

    /**
     * Use this method to delete a forum topic along with all its messages in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     * @return bool Returns True on success
     */
    public function deleteForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): bool;

    /**
     * Use this method to delete a message, including service messages.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $message_id Identifier of the message to delete
     * @return bool Returns True on success
     */
    public function deleteMessage(
        int|string $chat_id,
        int $message_id,
    ): bool;

    /**
     * Use this method to delete multiple messages simultaneously.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int[] $message_ids A list of 1-100 identifiers of messages to delete
     * @return bool Returns True on success
     */
    public function deleteMessages(
        int|string $chat_id,
        array $message_ids,
    ): bool;

    /**
     * Use this method to delete the list of the bot's commands for the given scope and user language.
     * @param BotCommandScope|null $scope A JSON-serialized object, describing scope of users for which the commands are relevant
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return bool Returns True on success
     */
    public function deleteMyCommands(
        ?BotCommandScope $scope = null,
        ?string $language_code = null,
    ): bool;

    /**
     * Deletes a story previously posted by the bot on behalf of a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int $story_id Unique identifier of the story to delete
     * @return bool Returns True on success
     */
    public function deleteStory(
        string $business_connection_id,
        int $story_id,
    ): bool;

    /**
     * Use this method to delete a sticker from a set created by the bot.
     * @param string $sticker File identifier of the sticker
     * @return bool Returns True on success
     */
    public function deleteStickerFromSet(
        string $sticker,
    ): bool;

    /**
     * Use this method to delete a sticker set that was created by the bot.
     * @param string $name Sticker set name
     * @return bool Returns True on success
     */
    public function deleteStickerSet(
        string $name,
    ): bool;

    /**
     * Use this method to edit a non-primary invite link created by the bot.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string $invite_link The invite link to edit
     * @param string|null $name Invite link name
     * @param int|null $expire_date Point in time (Unix timestamp) when the link will expire
     * @param int|null $member_limit Maximum number of users that can be members of the chat simultaneously
     * @param bool|null $creates_join_request True, if users joining the chat via the link need to be approved
     * @return ChatInviteLink Returns the edited invite link as a ChatInviteLink object
     */
    public function editChatInviteLink(
        int|string $chat_id,
        string $invite_link,
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        ?bool $creates_join_request = null,
    ): ChatInviteLink;

    /**
     * Use this method to edit a subscription invite link created by the bot.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string $invite_link The invite link to edit
     * @param string|null $name Invite link name
     * @return ChatInviteLink Returns the edited invite link as a ChatInviteLink object
     */
    public function editChatSubscriptionInviteLink(
        int|string $chat_id,
        string $invite_link,
        ?string $name = null,
    ): ChatInviteLink;

    /**
     * Use this method to edit name and icon of a topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     * @param string|null $name New topic name
     * @param string|null $icon_custom_emoji_id New unique identifier of the custom emoji shown as the topic icon
     * @return bool Returns True on success
     */
    public function editForumTopic(
        int|string $chat_id,
        int $message_thread_id,
        ?string $name = null,
        ?string $icon_custom_emoji_id = null,
    ): bool;

    /**
     * Use this method to edit captions of messages.
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|string|null $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel
     * @param int|null $message_id Required if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param string|null $caption New caption of the message
     * @param string|null $parse_mode Mode for parsing entities in the message caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param bool|null $show_caption_above_media Pass True if the caption must be shown above the message media
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message|bool Returns the edited Message if the message is not an inline message, otherwise returns True
     */
    public function editMessageCaption(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool;

    /**
     * Use this method to edit a checklist message sent on behalf of a business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $message_id Identifier of the message to edit
     * @param InputChecklist $checklist An object describing the checklist to replace the current one
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message|bool Returns the edited Message if the message is not an inline message, otherwise returns True
     */
    public function editMessageChecklist(
        string $business_connection_id,
        int|string $chat_id,
        int $message_id,
        InputChecklist $checklist,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool;

    /**
     * Use this method to edit live location messages.
     * @param float $latitude Latitude of new location
     * @param float $longitude Longitude of new location
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|string|null $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel
     * @param int|null $message_id Required if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param int|null $live_period New period in seconds during which the location can be updated
     * @param float|null $horizontal_accuracy The radius of uncertainty for the location
     * @param int|null $heading Direction in which the user is moving, in degrees
     * @param int|null $proximity_alert_radius The maximum distance for proximity alerts about approaching another chat member
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message|bool Returns the edited Message if the message is not an inline message, otherwise returns True
     */
    public function editMessageLiveLocation(
        float $latitude,
        float $longitude,
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?int $live_period = null,
        ?float $horizontal_accuracy = null,
        ?int $heading = null,
        ?int $proximity_alert_radius = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool;

    /**
     * Use this method to edit animation, audio, document, photo, or video messages.
     * @param InputMedia $media A JSON-serialized object for a new media content of the message
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|string|null $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel
     * @param int|null $message_id Required if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message|bool Returns the edited Message if the message is not an inline message, otherwise returns True
     */
    public function editMessageMedia(
        InputMedia $media,
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool;

    /**
     * Use this method to edit only the reply markup of messages.
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|string|null $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel
     * @param int|null $message_id Required if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message|bool Returns the edited Message if the message is not an inline message, otherwise returns True
     */
    public function editMessageReplyMarkup(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool;

    /**
     * Use this method to edit text and game messages.
     * @param string $text New text of the message
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|string|null $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel
     * @param int|null $message_id Required if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param string|null $parse_mode Mode for parsing entities in the message text
     * @param MessageEntity[]|null $entities List of special entities that appear in message text
     * @param LinkPreviewOptions|null $link_preview_options Link preview generation options for the message
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message|bool Returns the edited Message if the message is not an inline message, otherwise returns True
     */
    public function editMessageText(
        string $text,
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?string $parse_mode = null,
        ?array $entities = null,
        ?LinkPreviewOptions $link_preview_options = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool;

    /**
     * Use this method to edit the name of the 'General' topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param string $name New topic name, 1-128 characters
     * @return bool Returns True on success
     */
    public function editGeneralForumTopic(
        int|string $chat_id,
        string $name,
    ): bool;

    /**
     * Edits a story previously posted by the bot on behalf of a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int $story_id Unique identifier of the story to edit
     * @param InputStoryContent $content Content of the story
     * @param string|null $caption Caption of the story
     * @param string|null $parse_mode Mode for parsing entities in the story caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param StoryArea[]|null $areas A list of clickable areas to be shown on the story
     * @return Story Returns Story on success
     */
    public function editStory(
        string $business_connection_id,
        int $story_id,
        InputStoryContent $content,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?array $areas = null,
    ): Story;

    /**
     * Allows the bot to cancel or re-enable extension of a subscription paid in Telegram Stars.
     * @param int $user_id Identifier of the user whose subscription will be edited
     * @param string $telegram_payment_charge_id Telegram payment identifier for the subscription
     * @param bool $is_canceled Pass True to cancel extension of the user subscription; the subscription must be active up to the end of the current subscription period. Pass False to allow the user to re-enable it.
     * @return bool Returns True on success
     */
    public function editUserStarSubscription(
        int $user_id,
        string $telegram_payment_charge_id,
        bool $is_canceled,
    ): bool;

    /**
     * Use this method to generate a new primary invite link for a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @return string Returns the new invite link as String on success
     */
    public function exportChatInviteLink(
        int|string $chat_id,
    ): string;

    /**
     * Use this method to forward messages of any kind.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int|string $from_chat_id Unique identifier for the chat where the original message was sent
     * @param int $message_id Message identifier in the chat specified in from_chat_id
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param int|null $video_start_timestamp New start timestamp for the forwarded video in seconds
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the forwarded message from forwarding and saving
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @return Message Returns the sent Message on success
     */
    public function forwardMessage(
        int|string $chat_id,
        int|string $from_chat_id,
        int $message_id,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?int $video_start_timestamp = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
    ): Message;

    /**
     * Use this method to forward multiple messages of any kind.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int|string $from_chat_id Unique identifier for the chat where the original messages were sent
     * @param int[] $message_ids A list of 1-100 identifiers of messages in the chat from_chat_id to forward
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param bool|null $disable_notification Sends the messages silently
     * @param bool|null $protect_content Protects the contents of the forwarded messages from forwarding and saving
     * @return MessageId[] Returns an array of MessageId of the sent messages on success
     */
    public function forwardMessages(
        int|string $chat_id,
        int|string $from_chat_id,
        array $message_ids,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
    ): array;

    /**
     * Returns the list of gifts that can be sent by the bot to users.
     * @return Gifts Returns a Gifts object
     */
    public function getAvailableGifts(): Gifts;

    /**
     * Returns the gifts received and owned by a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param bool|null $exclude_unsaved Pass True to exclude gifts that aren't saved to the account's profile page
     * @param bool|null $exclude_saved Pass True to exclude gifts that are saved to the account's profile page
     * @param bool|null $exclude_unlimited Pass True to exclude gifts that can be purchased an unlimited number of times
     * @param bool|null $exclude_limited_upgradable Pass True to exclude limited gifts that can be upgraded
     * @param bool|null $exclude_limited_non_upgradable Pass True to exclude limited gifts that cannot be upgraded
     * @param bool|null $exclude_from_blockchain Pass True to exclude gifts on the TON blockchain
     * @param bool|null $exclude_unique Pass True to exclude unique gifts
     * @param bool|null $sort_by_price Pass True to sort results by gift price instead of send date
     * @param string|null $offset Offset of the first entry to return as received from the previous request
     * @param int|null $limit The maximum number of gifts to be returned; 1-100
     * @return OwnedGifts Returns an OwnedGifts object
     */
    public function getBusinessAccountGifts(
        string $business_connection_id,
        ?bool $exclude_unsaved = null,
        ?bool $exclude_saved = null,
        ?bool $exclude_unlimited = null,
        ?bool $exclude_limited_upgradable = null,
        ?bool $exclude_limited_non_upgradable = null,
        ?bool $exclude_from_blockchain = null,
        ?bool $exclude_unique = null,
        ?bool $sort_by_price = null,
        ?string $offset = null,
        ?int $limit = null,
    ): OwnedGifts;

    /**
     * Returns the amount of Telegram Stars owned by a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @return StarAmount Returns a StarAmount object on success
     */
    public function getBusinessAccountStarBalance(
        string $business_connection_id,
    ): StarAmount;

    /**
     * Use this method to get information about the connection of the bot with a business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @return BusinessConnection Returns a BusinessConnection object on success
     */
    public function getBusinessConnection(
        string $business_connection_id,
    ): BusinessConnection;

    /**
     * Use this method to get up-to-date information about the chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     * @return ChatFullInfo Returns a ChatFullInfo object on success
     */
    public function getChat(
        int|string $chat_id,
    ): ChatFullInfo;

    /**
     * Use this method to get a list of administrators in a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     * @return ChatMember[] Returns an Array of ChatMember objects
     */
    public function getChatAdministrators(
        int|string $chat_id,
    ): array;

    /**
     * Returns the gifts received and owned by a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param bool|null $exclude_unsaved Pass True to exclude gifts that aren't saved to the chat's profile page
     * @param bool|null $exclude_saved Pass True to exclude gifts that are saved to the chat's profile page
     * @param bool|null $exclude_unlimited Pass True to exclude gifts that can be purchased an unlimited number of times
     * @param bool|null $exclude_limited_upgradable Pass True to exclude limited gifts that can be upgraded
     * @param bool|null $exclude_limited_non_upgradable Pass True to exclude limited gifts that cannot be upgraded
     * @param bool|null $exclude_from_blockchain Pass True to exclude gifts on the TON blockchain
     * @param bool|null $exclude_unique Pass True to exclude unique gifts
     * @param bool|null $sort_by_price Pass True to sort results by gift price instead of send date
     * @param string|null $offset Offset of the first entry to return as received from the previous request
     * @param int|null $limit The maximum number of gifts to be returned; 1-100
     * @return OwnedGifts Returns an OwnedGifts object
     */
    public function getChatGifts(
        int|string $chat_id,
        ?bool $exclude_unsaved = null,
        ?bool $exclude_saved = null,
        ?bool $exclude_unlimited = null,
        ?bool $exclude_limited_upgradable = null,
        ?bool $exclude_limited_non_upgradable = null,
        ?bool $exclude_from_blockchain = null,
        ?bool $exclude_unique = null,
        ?bool $sort_by_price = null,
        ?string $offset = null,
        ?int $limit = null,
    ): OwnedGifts;

    /**
     * Use this method to get information about a member of a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     * @param int $user_id Unique identifier of the target user
     * @return ChatMember Returns a ChatMember object on success
     */
    public function getChatMember(
        int|string $chat_id,
        int $user_id,
    ): ChatMember;

    /**
     * Use this method to get the number of members in a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     * @return int Returns Int on success
     */
    public function getChatMemberCount(
        int|string $chat_id,
    ): int;

    /**
     * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button.
     * @param int|null $chat_id Unique identifier for the target private chat
     * @return MenuButton Returns MenuButton on success
     */
    public function getChatMenuButton(
        ?int $chat_id = null,
    ): MenuButton;

    /**
     * Use this method to get information about custom emoji stickers by their identifiers.
     * @param string[] $custom_emoji_ids A list of custom emoji identifiers
     * @return Sticker[] Returns an Array of Sticker objects
     */
    public function getCustomEmojiStickers(
        array $custom_emoji_ids,
    ): array;

    /**
     * Use this method to get basic information about a file and prepare it for downloading.
     * @param string $file_id File identifier to get information about
     * @return File Returns a File object on success
     */
    public function getFile(
        string $file_id,
    ): File;

    /**
     * Use this method to get custom emoji stickers, which can be used as a forum topic icon by any user.
     * @return Sticker[] Returns an Array of Sticker objects
     */
    public function getForumTopicIconStickers(): array;

    /**
     * Use this method to get data for high score tables.
     * @param int $user_id Target user id
     * @param int|null $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat
     * @param int|null $message_id Required if inline_message_id is not specified. Identifier of the sent message
     * @param string|null $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @return GameHighScore[] Returns an Array of GameHighScore objects
     */
    public function getGameHighScores(
        int $user_id,
        ?int $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
    ): array;

    /**
     * A simple method for testing your bot's authentication token.
     * @return User Returns basic information about the bot in form of a User object
     */
    public function getMe(): User;

    /**
     * Use this method to get the current list of the bot's commands for the given scope and user language.
     * @param BotCommandScope|null $scope A JSON-serialized object, describing scope of users
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return BotCommand[] Returns an Array of BotCommand objects
     */
    public function getMyCommands(
        ?BotCommandScope $scope = null,
        ?string $language_code = null,
    ): array;

    /**
     * Use this method to get the current default administrator rights of the bot.
     * @param bool|null $for_channels Pass True to get default administrator rights of the bot in channels
     * @return ChatAdministratorRights Returns ChatAdministratorRights on success
     */
    public function getMyDefaultAdministratorRights(
        ?bool $for_channels = null,
    ): ChatAdministratorRights;

    /**
     * Use this method to get the current bot description for the given user language.
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return BotDescription Returns BotDescription on success
     */
    public function getMyDescription(
        ?string $language_code = null,
    ): BotDescription;

    /**
     * Use this method to get the current bot name for the given user language.
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return BotName Returns BotName on success
     */
    public function getMyName(
        string $language_code = '', // the API does not accept null as a parameter and requires empty string instead
    ): BotName;

    /**
     * Use this method to get the current bot short description for the given user language.
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return BotShortDescription Returns BotShortDescription on success
     */
    public function getMyShortDescription(
        ?string $language_code = null,
    ): BotShortDescription;

    /**
     * Returns the current bot's Telegram Star balance.
     * @return StarAmount Returns a StarAmount object on success
     */
    public function getMyStarBalance(): StarAmount;

    /**
     * Use this method to get data about the bot's Telegram Star transactions.
     * @param int|null $offset Number of the first transaction to return
     * @param int|null $limit The maximum number of transactions to be retrieved
     * @return StarTransactions Returns a StarTransactions object on success
     */
    public function getStarTransactions(
        ?int $offset = null,
        ?int $limit = null,
    ): StarTransactions;

    /**
     * Use this method to get a sticker set.
     * @param string $name Name of the sticker set
     * @return StickerSet Returns a StickerSet object on success
     */
    public function getStickerSet(
        string $name,
    ): StickerSet;

    /**
     * Use this method to receive incoming updates using long polling. Returns an Array of Update objects
     * @param int|string $offset Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The negative offset can be specified to retrieve updates starting from -offset update from the end of the updates queue. All previous updates will be forgotten.
     * @param int $limit 	Limits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     * @param int $timeout 	Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be positive, short polling should be used for testing purposes only.
     * @param int $allowed_updates A JSON-serialized list of the update types you want your bot to receive. For example, specify ["message", "edited_channel_post", "callback_query"] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member, message_reaction, and message_reaction_count (default). If not specified, the previous setting will be used.
     * @return Update[] Returns an Array of Update objects.
     * 
     */
    public function getUpdates(
        ?int $offset = null,
        int $limit = 100,
        int $timeout = 0,
        array $allowed_updates = [],
    ): array;

    /**
     * Use this method to get the list of boosts added to a chat by a user.
     * @param int|string $chat_id Unique identifier for the chat or username of the channel
     * @param int $user_id Unique identifier of the target user
     * @return UserChatBoosts Returns a UserChatBoosts object
     */
    public function getUserChatBoosts(
        int|string $chat_id,
        int $user_id,
    ): UserChatBoosts;

    /**
     * Returns the gifts received and owned by a user.
     * @param int $user_id Unique identifier of the target user
     * @param bool|null $exclude_unlimited Pass True to exclude gifts that can be purchased an unlimited number of times
     * @param bool|null $exclude_limited_upgradable Pass True to exclude limited gifts that can be upgraded
     * @param bool|null $exclude_limited_non_upgradable Pass True to exclude limited gifts that cannot be upgraded
     * @param bool|null $exclude_from_blockchain Pass True to exclude gifts on the TON blockchain
     * @param bool|null $sort_by_price Pass True to sort results by gift price instead of send date
     * @param string|null $offset Offset of the first entry to return as received from the previous request
     * @param int|null $limit The maximum number of gifts to be returned; 1-100
     * @return OwnedGifts Returns an OwnedGifts object
     */
    public function getUserGifts(
        int $user_id,
        ?bool $exclude_unlimited = null,
        ?bool $exclude_limited_upgradable = null,
        ?bool $exclude_limited_non_upgradable = null,
        ?bool $exclude_from_blockchain = null,
        ?bool $sort_by_price = null,
        ?string $offset = null,
        ?int $limit = null,
    ): OwnedGifts;

    /**
     * Use this method to get a list of profile pictures for a user.
     * @param int $user_id Unique identifier of the target user
     * @param int|null $offset Sequential number of the first photo to be returned
     * @param int|null $limit Limits the number of photos to be retrieved. Values between 1-100 are accepted
     * @return UserProfilePhotos Returns a UserProfilePhotos object
     */
    public function getUserProfilePhotos(
        int $user_id,
        ?int $offset = null,
        ?int $limit = null,
    ): UserProfilePhotos;

    /**
     * Gifts a Telegram Premium subscription to the given user.
     * @param int $user_id Unique identifier of the target user that will receive the gift
     * @param int $month_count Number of months the Telegram Premium subscription will be active for the user; must be one of 3, 6, or 12
     * @param int $star_count Number of Telegram Stars to pay for the gift
     * @param string|null $text Text that will be shown along with the service message about the subscription
     * @param string|null $text_parse_mode Mode for parsing entities in the text
     * @param MessageEntity[]|null $text_entities List of special entities that appear in the gift text
     * @return bool Returns True on success
     */
    public function giftPremiumSubscription(
        int $user_id,
        int $month_count,
        int $star_count,
        ?string $text = null,
        ?string $text_parse_mode = null,
        ?array $text_entities = null,
    ): bool;

    /**
     * Use this method to hide the 'General' topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @return bool Returns True on success
     */
    public function hideGeneralForumTopic(
        int|string $chat_id,
    ): bool;

    /**
     * Use this method for your bot to leave a group, supergroup or channel.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup or channel
     * @return bool Returns True on success
     */
    public function leaveChat(
        int|string $chat_id,
    ): bool;

    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally.
     * @return bool Returns True on success
     */
    public function logOut(): bool;

    /**
     * Use this method to add a message to the list of pinned messages in a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $message_id Identifier of a message to pin
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param bool|null $disable_notification Pass True if it is not necessary to send a notification to all chat members about the new pinned message
     * @return bool Returns True on success
     */
    public function pinChatMessage(
        int|string $chat_id,
        int $message_id,
        ?string $business_connection_id = null,
        ?bool $disable_notification = null,
    ): bool;

    /**
     * Posts a story on behalf of a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param InputStoryContent $content Content of the story
     * @param int $active_period Period after which the story is moved to the archive, in seconds; must be one of 6 * 3600, 12 * 3600, 86400, or 2 * 86400
     * @param string|null $caption Caption of the story
     * @param string|null $parse_mode Mode for parsing entities in the story caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param StoryArea[]|null $areas A list of clickable areas to be shown on the story
     * @param bool|null $post_to_chat_page Pass True to keep the story accessible after it expires
     * @param bool|null $protect_content Pass True if the content of the story must be protected from forwarding and screenshotting
     * @return Story Returns Story on success
     */
    public function postStory(
        string $business_connection_id,
        InputStoryContent $content,
        int $active_period,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?array $areas = null,
        ?bool $post_to_chat_page = null,
        ?bool $protect_content = null,
    ): Story;

    /**
     * Use this method to promote or demote a user in a supergroup or a channel.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $user_id Unique identifier of the target user
     * @param bool|null $is_anonymous Pass True if the administrator's presence in the chat is hidden
     * @param bool|null $can_manage_chat Pass True if the administrator can access the chat event log, boost list in channels, etc.
     * @param bool|null $can_delete_messages Pass True if the administrator can delete messages of other users
     * @param bool|null $can_manage_video_chats Pass True if the administrator can manage video chats
     * @param bool|null $can_restrict_members Pass True if the administrator can restrict, ban or unban chat members
     * @param bool|null $can_promote_members Pass True if the administrator can add new administrators
     * @param bool|null $can_change_info Pass True if the administrator can change chat title, photo and other settings
     * @param bool|null $can_invite_users Pass True if the administrator can invite new users to the chat
     * @param bool|null $can_post_messages Pass True if the administrator can post messages in the channel (channels only)
     * @param bool|null $can_edit_messages Pass True if the administrator can edit messages of other users and can pin messages (channels only)
     * @param bool|null $can_pin_messages Pass True if the administrator can pin messages (supergroups only)
     * @param bool|null $can_post_stories Pass True if the administrator can post stories to the chat
     * @param bool|null $can_edit_stories Pass True if the administrator can edit stories posted by other users
     * @param bool|null $can_delete_stories Pass True if the administrator can delete stories posted by other users
     * @param bool|null $can_manage_topics Pass True if the user is allowed to create, rename, close, and reopen forum topics (supergroups only)
     * @param bool|null $can_manage_direct_messages Pass True if the administrator can manage direct messages of the channel
     * @return bool Returns True on success
     */
    public function promoteChatMember(
        int|string $chat_id,
        int $user_id,
        ?bool $is_anonymous = null,
        ?bool $can_manage_chat = null,
        ?bool $can_delete_messages = null,
        ?bool $can_manage_video_chats = null,
        ?bool $can_restrict_members = null,
        ?bool $can_promote_members = null,
        ?bool $can_change_info = null,
        ?bool $can_invite_users = null,
        ?bool $can_post_messages = null,
        ?bool $can_edit_messages = null,
        ?bool $can_pin_messages = null,
        ?bool $can_post_stories = null,
        ?bool $can_edit_stories = null,
        ?bool $can_delete_stories = null,
        ?bool $can_manage_topics = null,
        ?bool $can_manage_direct_messages = null,
    ): bool;

    /**
     * Marks incoming message as read on behalf of a business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int|string $chat_id Unique identifier of the chat in which the message was received
     * @param int $message_id Unique identifier of the message to mark as read
     * @return bool Returns True on success
     */
    public function readBusinessMessage(
        string $business_connection_id,
        int|string $chat_id,
        int $message_id,
    ): bool;

    /**
     * Removes the current profile photo of a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param bool|null $is_public Pass True to remove the public photo, which is visible even if the main photo is hidden by the business account's privacy settings
     * @return bool Returns True on success
     */
    public function removeBusinessAccountProfilePhoto(
        string $business_connection_id,
        ?bool $is_public = null,
    ): bool;

    /**
     * Removes verification from a chat that is currently verified on behalf of the organization represented by the bot.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @return bool Returns True on success
     */
    public function removeChatVerification(
        int|string $chat_id,
    ): bool;

    /**
     * Removes verification from a user who is currently verified on behalf of the organization represented by the bot.
     * @param int $user_id Unique identifier of the target user
     * @return bool Returns True on success
     */
    public function removeUserVerification(
        int $user_id,
    ): bool;

    /**
     * Refunds a successful payment in Telegram Stars.
     * @param int $user_id Identifier of the user whose payment will be refunded
     * @param string $telegram_payment_charge_id Telegram payment identifier for the payment
     * @return bool Returns True on success
     */
    public function refundStarPayment(
        int $user_id,
        string $telegram_payment_charge_id,
    ): bool;

    /**
     * Use this method to reopen a closed topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     * @return bool Returns True on success
     */
    public function reopenForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): bool;

    /**
     * Use this method to reopen a closed 'General' topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @return bool Returns True on success
     */
    public function reopenGeneralForumTopic(
        int|string $chat_id,
    ): bool;

    /**
     * Use this method to replace an existing sticker in a sticker set with a new one.
     * @param int $user_id User identifier of the sticker set owner
     * @param string $name Sticker set name
     * @param string $old_sticker File identifier of the replaced sticker
     * @param InputSticker $sticker A JSON-serialized object with information about the added sticker
     * @return bool Returns True on success
     */
    public function replaceStickerInSet(
        int $user_id,
        string $name,
        string $old_sticker,
        InputSticker $sticker,
    ): bool;

    /**
     * Reposts a story from a managed business account to the bot's own story page.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int $from_chat_id Unique identifier of the chat with the story to repost
     * @param int $from_story_id Identifier of the story to repost
     * @param int $active_period Period after which the story is moved to the archive, in seconds
     * @param bool|null $post_to_chat_page Pass True to keep the story accessible after it expires
     * @param bool|null $protect_content Pass True if the content of the story must be protected from forwarding and screenshotting
     * @return Story Returns Story on success
     */
    public function repostStory(
        string $business_connection_id,
        int $from_chat_id,
        int $from_story_id,
        int $active_period,
        ?bool $post_to_chat_page = null,
        ?bool $protect_content = null,
    ): Story;

    /**
     * Use this method to restrict a user in a supergroup.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param int $user_id Unique identifier of the target user
     * @param ChatPermissions $permissions A JSON-serialized object for new user permissions
     * @param bool|null $use_independent_chat_permissions Pass True if chat permissions are set independently
     * @param int|null $until_date Date when restrictions will be lifted for the user; Unix time
     * @return bool Returns True on success
     */
    public function restrictChatMember(
        int|string $chat_id,
        int $user_id,
        ChatPermissions $permissions,
        ?bool $use_independent_chat_permissions = null,
        ?int $until_date = null,
    ): bool;

    /**
     * Use this method to revoke an invite link created by the bot.
     * @param int|string $chat_id Unique identifier of the target chat or username of the target channel
     * @param string $invite_link The invite link to revoke
     * @return ChatInviteLink Returns the revoked invite link as ChatInviteLink object
     */
    public function revokeChatInviteLink(
        int|string $chat_id,
        string $invite_link,
    ): ChatInviteLink;

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound).
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile|string $animation Animation to send
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param int|null $duration Duration of sent animation in seconds
     * @param int|null $width Animation width
     * @param int|null $height Animation height
     * @param InputFile|string|null $thumbnail Thumbnail of the file sent
     * @param string|null $caption Animation caption
     * @param string|null $parse_mode Mode for parsing entities in the animation caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param bool|null $show_caption_above_media Pass True if the caption must be shown above the message media
     * @param bool|null $has_spoiler Pass True if the animation needs to be covered with a spoiler animation
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendAnimation(
        int|string $chat_id,
        InputFile|string $animation,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        InputFile|string|null $thumbnail = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $has_spoiler = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send audio files.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile|string $audio Audio file to send
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $caption Audio caption
     * @param string|null $parse_mode Mode for parsing entities in the audio caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param int|null $duration Duration of the audio in seconds
     * @param string|null $performer Performer
     * @param string|null $title Track name
     * @param InputFile|string|null $thumbnail Thumbnail of the file sent
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendAudio(
        int|string $chat_id,
        InputFile|string $audio,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?int $duration = null,
        ?string $performer = null,
        ?string $title = null,
        InputFile|string|null $thumbnail = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string $action Type of action to broadcast
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread
     * @return bool Returns True on success
     */
    public function sendChatAction(
        int|string $chat_id,
        string $action,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
    ): bool;

    /**
     * Sends a checklist on behalf of a connected business account.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputChecklist $checklist An object describing the checklist to be sent
     * @param string $business_connection_id Unique identifier of the business connection
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message Returns the sent Message on success
     */
    public function sendChecklist(
        int|string $chat_id,
        InputChecklist $checklist,
        string $business_connection_id,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?string $message_effect_id = null,
        ?ReplyParameters $reply_parameters = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message;

    /**
     * Use this method to send phone contacts.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $last_name Contact's last name
     * @param string|null $vcard Additional data about the contact in the form of a vCard
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendContact(
        int|string $chat_id,
        string $phone_number,
        string $first_name,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $last_name = null,
        ?string $vcard = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send an animated emoji that will display a random value.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $emoji Emoji on which the dice throw animation is based
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendDice(
        int|string $chat_id,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $emoji = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send general files.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile|string $document File to send
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param InputFile|string|null $thumbnail Thumbnail of the file sent
     * @param string|null $caption Document caption
     * @param string|null $parse_mode Mode for parsing entities in the document caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param bool|null $disable_content_type_detection Disables automatic server-side content type detection for files uploaded using multipart/form-data
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendDocument(
        int|string $chat_id,
        InputFile|string $document,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        InputFile|string|null $thumbnail = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $disable_content_type_detection = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send a game.
     * @param int $chat_id Unique identifier for the target chat
     * @param string $game_short_name Short name of the game
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message Returns the sent Message on success
     */
    public function sendGame(
        int $chat_id,
        string $game_short_name,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?ReplyParameters $reply_parameters = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message;

    /**
     * Sends a gift to the given user or channel chat.
     * @param string $gift_id Identifier of the gift to send
     * @param int|null $user_id Unique identifier of the target user that will receive the gift
     * @param int|string|null $chat_id Unique identifier for the target chat or username of the target channel
     * @param bool|null $pay_for_upgrade Pass True to pay for the gift upgrade from the bot's balance
     * @param string|null $text Text that will be shown along with the gift
     * @param string|null $text_parse_mode Mode for parsing entities in the text
     * @param MessageEntity[]|null $text_entities List of special entities that appear in the gift text
     * @return bool Returns True on success
     */
    public function sendGift(
        string $gift_id,
        ?int $user_id = null,
        int|string|null $chat_id = null,
        ?bool $pay_for_upgrade = null,
        ?string $text = null,
        ?string $text_parse_mode = null,
        ?array $text_entities = null,
    ): bool;

    /**
     * Use this method to send invoices.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string $title Product name
     * @param string $description Product description
     * @param string $payload Bot-defined invoice payload
     * @param string $currency Three-letter ISO 4217 currency code or "XTR" for payments in Telegram Stars
     * @param LabeledPrice[] $prices Price breakdown, a list of components
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $provider_token Payment provider token
     * @param int|null $max_tip_amount The maximum accepted amount for tips in the smallest units of the currency
     * @param int[]|null $suggested_tip_amounts A list of suggested amounts of tips in the smallest units of the currency
     * @param string|null $start_parameter Unique deep-linking parameter
     * @param string|null $provider_data JSON-serialized data about the invoice, which will be shared with the payment provider
     * @param string|null $photo_url URL of the product photo for the invoice
     * @param int|null $photo_size Photo size in bytes
     * @param int|null $photo_width Photo width
     * @param int|null $photo_height Photo height
     * @param bool|null $need_name Pass True if you require the user's full name to complete the order
     * @param bool|null $need_phone_number Pass True if you require the user's phone number to complete the order
     * @param bool|null $need_email Pass True if you require the user's email address to complete the order
     * @param bool|null $need_shipping_address Pass True if you require the user's shipping address to complete the order
     * @param bool|null $send_phone_number_to_provider Pass True if the user's phone number should be sent to the provider
     * @param bool|null $send_email_to_provider Pass True if the user's email address should be sent to the provider
     * @param bool|null $is_flexible Pass True if the final price depends on the shipping method
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message Returns the sent Message on success
     */
    public function sendInvoice(
        int|string $chat_id,
        string $title,
        string $description,
        string $payload,
        string $currency,
        array $prices,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $provider_token = null,
        ?int $max_tip_amount = null,
        ?array $suggested_tip_amounts = null,
        ?string $start_parameter = null,
        ?string $provider_data = null,
        ?string $photo_url = null,
        ?int $photo_size = null,
        ?int $photo_width = null,
        ?int $photo_height = null,
        ?bool $need_name = null,
        ?bool $need_phone_number = null,
        ?bool $need_email = null,
        ?bool $need_shipping_address = null,
        ?bool $send_phone_number_to_provider = null,
        ?bool $send_email_to_provider = null,
        ?bool $is_flexible = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message;

    /**
     * Use this method to send point on the map.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param float $latitude Latitude of the location
     * @param float $longitude Longitude of the location
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param float|null $horizontal_accuracy The radius of uncertainty for the location
     * @param int|null $live_period Period in seconds during which the location will be updated
     * @param int|null $heading For live locations, a direction in which the user is moving
     * @param int|null $proximity_alert_radius For live locations, a maximum distance for proximity alerts
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendLocation(
        int|string $chat_id,
        float $latitude,
        float $longitude,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?float $horizontal_accuracy = null,
        ?int $live_period = null,
        ?int $heading = null,
        ?int $proximity_alert_radius = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send a group of photos, videos, documents or audios as an album.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputMedia[] $media An array describing messages to be sent, must include 2-10 items
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param bool|null $disable_notification Sends messages silently
     * @param bool|null $protect_content Protects the contents of the sent messages from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @return Message[] Returns an Array of Messages on success
     */
    public function sendMediaGroup(
        int|string $chat_id,
        array $media,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?ReplyParameters $reply_parameters = null,
    ): array;

    /**
     * Use this method to send text messages.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string $text Text of the message to be sent
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $parse_mode Mode for parsing entities in the message text
     * @param MessageEntity[]|null $entities List of special entities that appear in message text
     * @param LinkPreviewOptions|null $link_preview_options Link preview generation options for the message
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendMessage(
        int|string $chat_id,
        string $text,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $parse_mode = null,
        ?array $entities = null,
        ?LinkPreviewOptions $link_preview_options = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send a message draft on behalf of a business account.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $draft_id Identifier of the message draft to be sent
     * @param string $text Text of the message draft to be sent
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param string|null $parse_mode Mode for parsing entities in the message text
     * @param MessageEntity[]|null $entities List of special entities that appear in message text
     * @return bool Returns True on success
     */
    public function sendMessageDraft(
        int|string $chat_id,
        int $draft_id,
        string $text,
        ?int $message_thread_id = null,
        ?string $parse_mode = null,
        ?array $entities = null,
    ): bool;

    /**
     * Use this method to send paid media.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $star_count The number of Telegram Stars that must be paid to buy access to the media
     * @param InputPaidMedia[] $media An array describing the media to be sent
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $payload Bot-defined paid media payload
     * @param bool|null $show_caption_above_media Pass True if the caption must be shown above the message media
     * @param string|null $caption Media caption
     * @param string|null $parse_mode Mode for parsing entities in the media caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendPaidMedia(
        int|string $chat_id,
        int $star_count,
        array $media,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $payload = null,
        ?bool $show_caption_above_media = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send photos.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile|string $photo Photo to send
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $caption Photo caption
     * @param string|null $parse_mode Mode for parsing entities in the photo caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param bool|null $show_caption_above_media Pass True if the caption must be shown above the message media
     * @param bool|null $has_spoiler Pass True if the photo needs to be covered with a spoiler animation
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendPhoto(
        int|string $chat_id,
        InputFile|string $photo,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $has_spoiler = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send a native poll.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string $question Poll question
     * @param array $options A list of 2-10 answer options
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param string|null $question_parse_mode Mode for parsing entities in the question
     * @param MessageEntity[]|null $question_entities List of special entities that appear in the poll question
     * @param bool|null $is_anonymous True, if the poll needs to be anonymous
     * @param string|null $type Poll type, "quiz" or "regular"
     * @param bool|null $allows_multiple_answers True, if the poll allows multiple answers
     * @param int|null $correct_option_id 0-based identifier of the correct answer option
     * @param string|null $explanation Text that is shown when a user chooses an incorrect answer
     * @param string|null $explanation_parse_mode Mode for parsing entities in the explanation
     * @param MessageEntity[]|null $explanation_entities List of special entities that appear in the poll explanation
     * @param int|null $open_period Amount of time in seconds the poll will be active after creation
     * @param int|null $close_date Point in time (Unix timestamp) when the poll will be automatically closed
     * @param bool|null $is_closed Pass True if the poll needs to be immediately closed
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendPoll(
        int|string $chat_id,
        string $question,
        array $options,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?string $question_parse_mode = null,
        ?array $question_entities = null,
        ?bool $is_anonymous = null,
        ?string $type = null,
        ?bool $allows_multiple_answers = null,
        ?int $correct_option_id = null,
        ?string $explanation = null,
        ?string $explanation_parse_mode = null,
        ?array $explanation_entities = null,
        ?int $open_period = null,
        ?int $close_date = null,
        ?bool $is_closed = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send static .WEBP, animated .TGS, or video .WEBM stickers.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile|string $sticker Sticker to send
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $emoji Emoji associated with the sticker
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendSticker(
        int|string $chat_id,
        InputFile|string $sticker,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $emoji = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send information about a venue.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param float $latitude Latitude of the venue
     * @param float $longitude Longitude of the venue
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $foursquare_id Foursquare identifier of the venue
     * @param string|null $foursquare_type Foursquare type of the venue
     * @param string|null $google_place_id Google Places identifier of the venue
     * @param string|null $google_place_type Google Places type of the venue
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendVenue(
        int|string $chat_id,
        float $latitude,
        float $longitude,
        string $title,
        string $address,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $foursquare_id = null,
        ?string $foursquare_type = null,
        ?string $google_place_id = null,
        ?string $google_place_type = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send video files.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile|string $video Video to send
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param int|null $duration Duration of sent video in seconds
     * @param int|null $width Video width
     * @param int|null $height Video height
     * @param InputFile|string|null $thumbnail Thumbnail of the file sent
     * @param InputFile|string|null $cover Cover for the video in the message
     * @param int|null $start_timestamp Timestamp in seconds from which the video will start playing
     * @param string|null $caption Video caption
     * @param string|null $parse_mode Mode for parsing entities in the video caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param bool|null $show_caption_above_media Pass True if the caption must be shown above the message media
     * @param bool|null $has_spoiler Pass True if the video needs to be covered with a spoiler animation
     * @param bool|null $supports_streaming Pass True if the uploaded video is suitable for streaming
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendVideo(
        int|string $chat_id,
        InputFile|string $video,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?int $duration = null,
        ?int $width = null,
        ?int $height = null,
        InputFile|string|null $thumbnail = null,
        InputFile|string|null $cover = null,
        ?int $start_timestamp = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $show_caption_above_media = null,
        ?bool $has_spoiler = null,
        ?bool $supports_streaming = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send video messages.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile|string $video_note Video note to send
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param int|null $duration Duration of sent video in seconds
     * @param int|null $length Video width and height
     * @param InputFile|string|null $thumbnail Thumbnail of the file sent
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendVideoNote(
        int|string $chat_id,
        InputFile|string $video_note,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?int $duration = null,
        ?int $length = null,
        InputFile|string|null $thumbnail = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Use this method to send audio files.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile|string $voice Audio file to send
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_thread_id Unique identifier for the target message thread (topic) of the forum
     * @param int|null $direct_messages_topic_id Unique identifier for the target direct messages topic of the forum
     * @param string|null $caption Voice message caption
     * @param string|null $parse_mode Mode for parsing entities in the voice message caption
     * @param MessageEntity[]|null $caption_entities List of special entities that appear in the caption
     * @param int|null $duration Duration of the voice message in seconds
     * @param bool|null $disable_notification Sends the message silently
     * @param bool|null $protect_content Protects the contents of the sent message from forwarding and saving
     * @param bool|null $allow_paid_broadcast Pass True to allow up to 1000 messages per second
     * @param string|null $message_effect_id Unique identifier of the message effect to be added to the message
     * @param SuggestedPostParameters|null $suggested_post_parameters Parameters for scheduling or suggesting the message as a channel post
     * @param ReplyParameters|null $reply_parameters Description of the message to reply to
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup Additional interface options
     * @return Message Returns the sent Message on success
     */
    public function sendVoice(
        int|string $chat_id,
        InputFile|string $voice,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?int $duration = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $allow_paid_broadcast = null,
        ?string $message_effect_id = null,
        ?SuggestedPostParameters $suggested_post_parameters = null,
        ?ReplyParameters $reply_parameters = null,
        InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $reply_markup = null,
    ): Message;

    /**
     * Changes the bio of a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string|null $bio The new value of the bio for the business account
     * @return bool Returns True on success
     */
    public function setBusinessAccountBio(
        string $business_connection_id,
        ?string $bio = null,
    ): bool;

    /**
     * Changes the settings of a managed business account for receiving gifts.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param bool $show_gift_button Pass True to show the gift button in the business account's profile
     * @param AcceptedGiftTypes $accepted_gift_types Types of gifts accepted by the business account
     * @return bool Returns True on success
     */
    public function setBusinessAccountGiftSettings(
        string $business_connection_id,
        bool $show_gift_button,
        AcceptedGiftTypes $accepted_gift_types,
    ): bool;

    /**
     * Changes the first and last name of a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string $first_name The new value of the first name for the business account
     * @param string|null $last_name The new value of the optional last name for the business account
     * @return bool Returns True on success
     */
    public function setBusinessAccountName(
        string $business_connection_id,
        string $first_name,
        ?string $last_name = null,
    ): bool;

    /**
     * Changes the profile photo of a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param InputProfilePhoto $photo The new profile photo to set
     * @param bool|null $is_public Pass True to set the public photo
     * @return bool Returns True on success
     */
    public function setBusinessAccountProfilePhoto(
        string $business_connection_id,
        InputProfilePhoto $photo,
        ?bool $is_public = null,
    ): bool;

    /**
     * Changes the username of a managed business account.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string|null $username The new value of the username for the business account
     * @return bool Returns True on success
     */
    public function setBusinessAccountUsername(
        string $business_connection_id,
        ?string $username = null,
    ): bool;

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param int $user_id Unique identifier of the target user
     * @param string $custom_title New custom title for the administrator; 0-16 characters, emoji are not allowed
     * @return bool Returns True on success
     */
    public function setChatAdministratorCustomTitle(
        int|string $chat_id,
        int $user_id,
        string $custom_title,
    ): bool;

    /**
     * Use this method to change the description of a group, a supergroup or a channel.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string|null $description New chat description, 0-255 characters
     * @return bool Returns True on success
     */
    public function setChatDescription(
        int|string $chat_id,
        ?string $description = null,
    ): bool;

    /**
     * Use this method to change the bot's menu button in a private chat, or the default menu button.
     * @param int|null $chat_id Unique identifier for the target private chat
     * @param MenuButton|null $menu_button A JSON-serialized object for the bot's new menu button
     * @return bool Returns True on success
     */
    public function setChatMenuButton(
        ?int $chat_id = null,
        ?MenuButton $menu_button = null,
    ): bool;

    /**
     * Use this method to set default chat permissions for all members.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param ChatPermissions $permissions A JSON-serialized object for new default chat permissions
     * @param bool|null $use_independent_chat_permissions Pass True if chat permissions are set independently
     * @return bool Returns True on success
     */
    public function setChatPermissions(
        int|string $chat_id,
        ChatPermissions $permissions,
        ?bool $use_independent_chat_permissions = null,
    ): bool;

    /**
     * Use this method to set a new profile photo for the chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param InputFile $photo New chat photo, uploaded using multipart/form-data
     * @return bool Returns True on success
     */
    public function setChatPhoto(
        int|string $chat_id,
        InputFile $photo,
    ): bool;

    /**
     * Use this method to set a new group sticker set for a supergroup.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param string $sticker_set_name Name of the sticker set to be set as the group sticker set
     * @return bool Returns True on success
     */
    public function setChatStickerSet(
        int|string $chat_id,
        string $sticker_set_name,
    ): bool;

    /**
     * Use this method to change the title of a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string $title New chat title, 1-128 characters
     * @return bool Returns True on success
     */
    public function setChatTitle(
        int|string $chat_id,
        string $title,
    ): bool;

    /**
     * Use this method to set the thumbnail of a custom emoji sticker set.
     * @param string $name Sticker set name
     * @param string|null $custom_emoji_id Custom emoji identifier of a sticker from the sticker set
     * @return bool Returns True on success
     */
    public function setCustomEmojiStickerSetThumbnail(
        string $name,
        ?string $custom_emoji_id = null,
    ): bool;

    /**
     * Use this method to set the score of the specified user in a game message.
     * @param int $user_id User identifier
     * @param int $score New score, must be non-negative
     * @param bool|null $force Pass True if the high score is allowed to decrease
     * @param bool|null $disable_edit_message Pass True if the game message should not be automatically edited to include the current scoreboard
     * @param int|null $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat
     * @param int|null $message_id Required if inline_message_id is not specified. Identifier of the sent message
     * @param string|null $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @return Message|bool Returns the edited Message if the message is not an inline message, otherwise returns True
     */
    public function setGameScore(
        int $user_id,
        int $score,
        ?bool $force = null,
        ?bool $disable_edit_message = null,
        ?int $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
    ): Message|bool;

    /**
     * Use this method to change the chosen reactions on a message.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $message_id Identifier of the target message
     * @param ReactionType[]|null $reaction A list of reaction types to set on the message
     * @param bool|null $is_big Pass True to set the reaction with a big animation
     * @return bool Returns True on success
     */
    public function setMessageReaction(
        int|string $chat_id,
        int $message_id,
        ?array $reaction = null,
        ?bool $is_big = null,
    ): bool;

    /**
     * Use this method to change the list of the bot's commands.
     * @param BotCommand[] $commands A list of bot commands to be set as the list of the bot's commands
     * @param BotCommandScope|null $scope A JSON-serialized object, describing scope of users for which the commands are relevant
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return bool Returns True on success
     */
    public function setMyCommands(
        array $commands,
        ?BotCommandScope $scope = null,
        ?string $language_code = null,
    ): bool;

    /**
     * Use this method to change the default administrator rights requested by the bot.
     * @param ChatAdministratorRights|null $rights A JSON-serialized object describing new default administrator rights
     * @param bool|null $for_channels Pass True to change the default administrator rights of the bot in channels
     * @return bool Returns True on success
     */
    public function setMyDefaultAdministratorRights(
        ?ChatAdministratorRights $rights = null,
        ?bool $for_channels = null,
    ): bool;

    /**
     * Use this method to change the bot's description.
     * @param string|null $description New bot description
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return bool Returns True on success
     */
    public function setMyDescription(
        ?string $description = null,
        ?string $language_code = null,
    ): bool;

    /**
     * Use this method to change the bot's name.
     * @param string|null $name New bot name; 0-64 characters
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return bool Returns True on success
     */
    public function setMyName(
        ?string $name = null,
        ?string $language_code = null,
    ): bool;

    /**
     * Use this method to change the bot's short description.
     * @param string|null $short_description New short description for the bot
     * @param string|null $language_code A two-letter ISO 639-1 language code
     * @return bool Returns True on success
     */
    public function setMyShortDescription(
        ?string $short_description = null,
        ?string $language_code = null,
    ): bool;

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors.
     * @param int $user_id User identifier
     * @param PassportElementError[] $errors A list describing the errors
     * @return bool Returns True on success
     */
    public function setPassportDataErrors(
        int $user_id,
        array $errors,
    ): bool;

    /**
     * Use this method to change the list of emoji assigned to a regular or custom emoji sticker.
     * @param string $sticker File identifier of the sticker
     * @param string[] $emoji_list A list of 1-20 emoji associated with the sticker
     * @return bool Returns True on success
     */
    public function setStickerEmojiList(
        string $sticker,
        array $emoji_list,
    ): bool;

    /**
     * Use this method to change search keywords assigned to a regular or custom emoji sticker.
     * @param string $sticker File identifier of the sticker
     * @param string[]|null $keywords A list of 0-20 search keywords for the sticker
     * @return bool Returns True on success
     */
    public function setStickerKeywords(
        string $sticker,
        ?array $keywords = null,
    ): bool;

    /**
     * Use this method to change the mask position of a mask sticker.
     * @param string $sticker File identifier of the sticker
     * @param MaskPosition|null $mask_position A JSON-serialized object with the position where the mask should be placed on faces
     * @return bool Returns True on success
     */
    public function setStickerMaskPosition(
        string $sticker,
        ?MaskPosition $mask_position = null,
    ): bool;

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position.
     * @param string $sticker File identifier of the sticker
     * @param int $position New sticker position in the set, zero-based
     * @return bool Returns True on success
     */
    public function setStickerPositionInSet(
        string $sticker,
        int $position,
    ): bool;

    /**
     * Use this method to set the thumbnail of a regular or mask sticker set.
     * @param string $name Sticker set name
     * @param int $user_id User identifier of the sticker set owner
     * @param string $format Format of the thumbnail
     * @param InputFile|string|null $thumbnail A .WEBP or .PNG image with the thumbnail
     * @return bool Returns True on success
     */
    public function setStickerSetThumbnail(
        string $name,
        int $user_id,
        string $format,
        InputFile|string|null $thumbnail = null,
    ): bool;

    /**
     * Use this method to set the title of a created sticker set.
     * @param string $name Sticker set name
     * @param string $title Sticker set title, 1-64 characters
     * @return bool Returns True on success
     */
    public function setStickerSetTitle(
        string $name,
        string $title,
    ): bool;

    /**
     * Changes the emoji status for a given user.
     * @param int $user_id Unique identifier of the target user
     * @param string|null $emoji_status_custom_emoji_id Custom emoji identifier of the emoji status to set
     * @param int|null $emoji_status_expiration_date Expiration date of the emoji status, if any
     * @return bool Returns True on success
     */
    public function setUserEmojiStatus(
        int $user_id,
        ?string $emoji_status_custom_emoji_id = null,
        ?int $emoji_status_expiration_date = null,
    ): bool;

    /**
     * Use this method to stop updating a live location message before live_period expires.
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|string|null $chat_id Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel
     * @param int|null $message_id Required if inline_message_id is not specified. Identifier of the message with live location to stop
     * @param string|null $inline_message_id Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for an inline keyboard
     * @return Message|bool Returns the edited Message if the message is not an inline message, otherwise returns True
     */
    public function stopMessageLiveLocation(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool;

    /**
     * Use this method to stop a poll which was sent by the bot.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $message_id Identifier of the original message with the poll
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param InlineKeyboardMarkup|null $reply_markup A JSON-serialized object for a new message inline keyboard
     * @return Poll Returns the stopped Poll on success
     */
    public function stopPoll(
        int|string $chat_id,
        int $message_id,
        ?string $business_connection_id = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Poll;

    /**
     * Transfers Telegram Stars from the business account balance to the bot's balance.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param int $star_count Number of Telegram Stars to transfer
     * @return bool Returns True on success
     */
    public function transferBusinessAccountStars(
        string $business_connection_id,
        int $star_count,
    ): bool;

    /**
     * Transfers an owned regular gift to another user.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string $owned_gift_id Unique identifier of the regular gift that should be transferred
     * @param int $new_owner_chat_id Unique identifier of the chat that will receive the gift
     * @param int|null $star_count The amount of Telegram Stars that will be paid for the transfer from the business account balance
     * @return bool Returns True on success
     */
    public function transferGift(
        string $business_connection_id,
        string $owned_gift_id,
        int $new_owner_chat_id,
        ?int $star_count = null,
    ): bool;

    /**
     * Use this method to unban a previously banned user in a supergroup or channel.
     * @param int|string $chat_id Unique identifier for the target group or username of the target supergroup or channel
     * @param int $user_id Unique identifier of the target user
     * @param bool|null $only_if_banned Do nothing if the user is not banned
     * @return bool Returns True on success
     */
    public function unbanChatMember(
        int|string $chat_id,
        int $user_id,
        ?bool $only_if_banned = null,
    ): bool;

    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param int $sender_chat_id Unique identifier of the target sender chat
     * @return bool Returns True on success
     */
    public function unbanChatSenderChat(
        int|string $chat_id,
        int $sender_chat_id,
    ): bool;

    /**
     * Use this method to unhide the 'General' topic in a forum supergroup chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @return bool Returns True on success
     */
    public function unhideGeneralForumTopic(
        int|string $chat_id,
    ): bool;

    /**
     * Use this method to clear the list of pinned messages in a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @return bool Returns True on success
     */
    public function unpinAllChatMessages(
        int|string $chat_id,
    ): bool;

    /**
     * Use this method to clear the list of pinned messages in a forum topic.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @param int $message_thread_id Unique identifier for the target message thread of the forum topic
     * @return bool Returns True on success
     */
    public function unpinAllForumTopicMessages(
        int|string $chat_id,
        int $message_thread_id,
    ): bool;

    /**
     * Use this method to clear the list of pinned messages in a General forum topic.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup
     * @return bool Returns True on success
     */
    public function unpinAllGeneralForumTopicMessages(
        int|string $chat_id,
    ): bool;

    /**
     * Use this method to remove a message from the list of pinned messages in a chat.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string|null $business_connection_id Unique identifier of the business connection
     * @param int|null $message_id Identifier of the message to unpin
     * @return bool Returns True on success
     */
    public function unpinChatMessage(
        int|string $chat_id,
        ?string $business_connection_id = null,
        ?int $message_id = null,
    ): bool;

    /**
     * Upgrades a given regular gift to a unique gift.
     * @param string $business_connection_id Unique identifier of the business connection
     * @param string $owned_gift_id Unique identifier of the regular gift that should be upgraded to a unique one
     * @param bool|null $keep_original_details Pass True to keep the original gift text, sender and receiver in the upgraded gift
     * @param int|null $star_count The amount of Telegram Stars that will be paid for the upgrade from the business account balance
     * @return bool Returns True on success
     */
    public function upgradeGift(
        string $business_connection_id,
        string $owned_gift_id,
        ?bool $keep_original_details = null,
        ?int $star_count = null,
    ): bool;

    /**
     * Use this method to upload a file with a sticker for later use in createNewStickerSet and addStickerToSet.
     * @param int $user_id User identifier of sticker file owner
     * @param InputFile $sticker A file with the sticker in .WEBP, .PNG, .TGS, or .WEBM format
     * @param string $sticker_format Format of the sticker
     * @return File Returns the uploaded File on success
     */
    public function uploadStickerFile(
        int $user_id,
        InputFile $sticker,
        string $sticker_format,
    ): File;

    /**
     * Verifies a chat on behalf of the organization represented by the bot.
     * @param int|string $chat_id Unique identifier for the target chat or username of the target channel
     * @param string|null $custom_description Custom description for the verification
     * @return bool Returns True on success
     */
    public function verifyChat(
        int|string $chat_id,
        ?string $custom_description = null,
    ): bool;

    /**
     * Verifies a user on behalf of the organization represented by the bot.
     * @param int $user_id Unique identifier of the target user
     * @param string|null $custom_description Custom description for the verification
     * @return bool Returns True on success
     */
    public function verifyUser(
        int $user_id,
        ?string $custom_description = null,
    ): bool;

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success.
     * @param bool|null $drop_pending_updates Pass True to drop all pending updates
     * @return bool Returns True on success
     */
    public function deleteWebhook(?bool $drop_pending_updates = null): bool;

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
     * @return WebHookInfo On success, returns a WebhookInfo object
     */
    public function getWebhookInfo(): WebHookInfo;

    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified URL, containing a JSON-serialized Update. In case of an unsuccessful request (a request with response HTTP status code different from 2XY), we will repeat the request and give up after a reasonable amount of attempts. Returns True on success.
     * If you'd like to make sure that the webhook was set by you, you can specify secret data in the parameter secret_token. If specified, the request will contain a header “X-Telegram-Bot-Api-Secret-Token” with the secret token as content.
     * @param bool|null $drop_pending_updates Pass True to drop all pending updates
     * 
     * @param string $url HTTPS URL to send updates to. Use an empty string to remove webhook integration
     * @param InputFile|null $certificate Upload your public key certificate so that the root certificate in use can be checked. See our self-signed guide for details.
     * @param string|null $ip_address The fixed IP address which will be used to send webhook requests instead of the IP address resolved through DNS
     * @param int|null $maxx_connections The maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot's server, and higher values to increase your bot's throughput.
     * @param array|null$allowed_updates A JSON-serialized list of the update types you want your bot to receive. For example, specify ["message", "edited_channel_post", "callback_query"] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member, message_reaction, and message_reaction_count (default). If not specified, the previous setting will be used. Please note that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted updates may be received for a short period of time.
     * @param bool|null $drop_pending_updates Pass True to drop all pending updates
     * @param string|null $secret_token A secret token to be sent in a header “X-Telegram-Bot-Api-Secret-Token” in every webhook request, 1-256 characters. Only characters A-Z, a-z, 0-9, _ and - are allowed. The header is useful to ensure that the request comes from a webhook set by you.
     * @return bool Returns True on success.
     */
    public function setWebhook(
        string $url,
        ?InputFile $certificate = null,
        ?string $ip_address = null,
        ?int $max_connections = null,
        ?array $allowed_updates = null,
        ?bool $drop_pending_updates = null,
        ?string $secret_token = null,
    ): bool;

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
