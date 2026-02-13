<?php

declare(strict_types=1);

namespace F4\Pechkin;

// Documentation: https://core.telegram.org/bots/api

use F4\Pechkin\{
    ClientInterface,
    Client\ApiClient,
};
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

use function
array_map,
get_defined_vars
;

class Client implements ClientInterface
{
    protected const string API_VERSION = '9.3';
    protected const int REQUEST_TIMEOUT = 60;

    protected ApiClient $apiClient;

    public function __construct(string $token)
    {
        $this->apiClient = new ApiClient($token);
    }

    public function addStickerToSet(
        int $user_id,
        string $name,
        InputSticker $sticker,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function answerCallbackQuery(
        string $callback_query_id,
        ?string $text = null,
        ?bool $show_alert = null,
        ?string $url = null,
        ?int $cache_time = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function answerInlineQuery(

        string $inline_query_id,
        array $results,
        ?int $cache_time = null,
        ?bool $is_personal = null,
        ?string $next_offset = null,
        ?InlineQueryResultsButton $button = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function answerPreCheckoutQuery(
        string $pre_checkout_query_id,
        bool $ok,
        ?string $error_message = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function answerShippingQuery(
        string $shipping_query_id,
        bool $ok,
        ?array $shipping_options = null,
        ?string $error_message = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function answerWebAppQuery(
        string $web_app_query_id,
        InlineQueryResult $result,
    ): SentWebAppMessage {
        return SentWebAppMessage::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function approveChatJoinRequest(
        int|string $chat_id,
        int $user_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function approveSuggestedPost(
        int|string $chat_id,
        int $message_id,
        ?int $send_date = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function banChatMember(
        int|string $chat_id,
        int $user_id,
        ?int $until_date = null,
        ?bool $revoke_messages = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function banChatSenderChat(
        int|string $chat_id,
        int $sender_chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function close(): bool
    {
        return $this->apiClient->sendJsonRequest(__FUNCTION__);
    }
    public function closeForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function closeGeneralForumTopic(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function convertGiftToStars(
        string $business_connection_id,
        string $owned_gift_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
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
    ): MessageId {
        return MessageId::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function copyMessages(
        int|string $chat_id,
        int|string $from_chat_id,
        array $message_ids,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?bool $remove_caption = null,
    ): array {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            callback: MessageId::fromArray(...),
        );
    }
    public function createChatInviteLink(
        int|string $chat_id,
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        ?bool $creates_join_request = null,
    ): ChatInviteLink {
        return ChatInviteLink::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function createChatSubscriptionInviteLink(
        int|string $chat_id,
        int $subscription_period,
        int $subscription_price,
        ?string $name = null,
    ): ChatInviteLink {
        return ChatInviteLink::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): string {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function createNewStickerSet(
        int $user_id,
        string $name,
        string $title,
        array $stickers,
        ?string $sticker_type = null,
        ?bool $needs_repainting = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function createForumTopic(
        int|string $chat_id,
        string $name,
        ?int $icon_color = null,
        ?string $icon_custom_emoji_id = null,
    ): ForumTopic {
        return ForumTopic::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function declineChatJoinRequest(
        int|string $chat_id,
        int $user_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function declineSuggestedPost(
        int|string $chat_id,
        int $message_id,
        ?string $comment = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteBusinessMessages(
        string $business_connection_id,
        array $message_ids,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteChatPhoto(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteChatStickerSet(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteMessage(
        int|string $chat_id,
        int $message_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteMessages(
        int|string $chat_id,
        array $message_ids,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteMyCommands(
        ?BotCommandScope $scope = null,
        ?string $language_code = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteStory(
        string $business_connection_id,
        int $story_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteStickerFromSet(
        string $sticker,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteStickerSet(
        string $name,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function deleteWebhook(
        ?bool $drop_pending_updates = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function editChatInviteLink(
        int|string $chat_id,
        string $invite_link,
        ?string $name = null,
        ?int $expire_date = null,
        ?int $member_limit = null,
        ?bool $creates_join_request = null,
    ): ChatInviteLink {
        return ChatInviteLink::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function editChatSubscriptionInviteLink(
        int|string $chat_id,
        string $invite_link,
        ?string $name = null,
    ): ChatInviteLink {
        return ChatInviteLink::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function editForumTopic(
        int|string $chat_id,
        int $message_thread_id,
        ?string $name = null,
        ?string $icon_custom_emoji_id = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function editGeneralForumTopic(
        int|string $chat_id,
        string $name,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
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
    ): Message|bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function editMessageChecklist(
        string $business_connection_id,
        int|string $chat_id,
        int $message_id,
        InputChecklist $checklist,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
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
    ): Message|bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function editMessageMedia(
        InputMedia $media,
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function editMessageReplyMarkup(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
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
    ): Message|bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function editStory(
        string $business_connection_id,
        int $story_id,
        InputStoryContent $content,
        ?string $caption = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?array $areas = null,
    ): Story {
        return Story::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function editUserStarSubscription(
        int $user_id,
        string $telegram_payment_charge_id,
        bool $is_canceled,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function exportChatInviteLink(
        int|string $chat_id,
    ): string {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function forwardMessages(
        int|string $chat_id,
        int|string $from_chat_id,
        array $message_ids,
        ?int $message_thread_id = null,
        ?int $direct_messages_topic_id = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
    ): array {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            callback: MessageId::fromArray(...),
        );
    }
    public function getAvailableGifts(): Gifts
    {
        return Gifts::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__));
    }
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
    ): OwnedGifts {
        return OwnedGifts::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getBusinessAccountStarBalance(
        string $business_connection_id,
    ): StarAmount {
        return StarAmount::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getBusinessConnection(
        string $business_connection_id,
    ): BusinessConnection {
        return BusinessConnection::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getChat(
        int|string $chat_id,
    ): ChatFullInfo {
        return ChatFullInfo::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getChatAdministrators(
        int|string $chat_id,
    ): array {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            callback: ChatMember::fromArray(...),
        );
    }
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
    ): OwnedGifts {
        return OwnedGifts::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getChatMember(
        int|string $chat_id,
        int $user_id,
    ): ChatMember {
        return ChatMember::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getChatMemberCount(
        int|string $chat_id,
    ): int {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function getChatMenuButton(
        ?int $chat_id = null,
    ): MenuButton {
        return MenuButton::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getCustomEmojiStickers(
        array $custom_emoji_ids,
    ): array {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            callback: Sticker::fromArray(...),
        );
    }
    public function getFile(
        string $file_id,
    ): File {
        return File::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getForumTopicIconStickers(): array
    {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__),
            callback: Sticker::fromArray(...),
        );
    }
    public function getGameHighScores(
        int $user_id,
        ?int $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
    ): array {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            callback: GameHighScore::fromArray(...),
        );
    }
    public function getMe(): User
    {
        return User::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__));
    }
    public function getMyCommands(
        ?BotCommandScope $scope = null,
        ?string $language_code = null,
    ): array {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            callback: BotCommand::fromArray(...),
        );
    }
    public function getMyDefaultAdministratorRights(
        ?bool $for_channels = null,
    ): ChatAdministratorRights {
        return ChatAdministratorRights::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getMyDescription(
        ?string $language_code = null,
    ): BotDescription {
        return BotDescription::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getMyName(
        string $language_code = '',
    ): BotName {
        return BotName::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getMyShortDescription(
        ?string $language_code = null,
    ): BotShortDescription {
        return BotShortDescription::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getMyStarBalance(): StarAmount
    {
        return StarAmount::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__));
    }
    public function getStarTransactions(
        ?int $offset = null,
        ?int $limit = null,
    ): StarTransactions {
        return StarTransactions::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getStickerSet(
        string $name,
    ): StickerSet {
        return StickerSet::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getUpdates(

        ?int $offset = null,
        int $limit = 100,
        int $timeout = 0,
        array $allowed_updates = [],
    ): array {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            callback: Update::fromArray(...),
        );
    }
    public function getUserChatBoosts(
        int|string $chat_id,
        int $user_id,
    ): UserChatBoosts {
        return UserChatBoosts::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getUserGifts(
        int $user_id,
        ?bool $exclude_unlimited = null,
        ?bool $exclude_limited_upgradable = null,
        ?bool $exclude_limited_non_upgradable = null,
        ?bool $exclude_from_blockchain = null,
        ?bool $sort_by_price = null,
        ?string $offset = null,
        ?int $limit = null,
    ): OwnedGifts {
        return OwnedGifts::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getUserProfilePhotos(
        int $user_id,
        ?int $offset = null,
        ?int $limit = null,
    ): UserProfilePhotos {
        return UserProfilePhotos::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function getWebhookInfo(): WebHookInfo
    {
        return WebHookInfo::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__));
    }
    public function giftPremiumSubscription(
        int $user_id,
        int $month_count,
        int $star_count,
        ?string $text = null,
        ?string $text_parse_mode = null,
        ?array $text_entities = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function hideGeneralForumTopic(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function leaveChat(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function logOut(): bool
    {
        return $this->apiClient->sendJsonRequest(__FUNCTION__);
    }
    public function pinChatMessage(
        int|string $chat_id,
        int $message_id,
        ?string $business_connection_id = null,
        ?bool $disable_notification = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
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
    ): Story {
        return Story::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function readBusinessMessage(
        string $business_connection_id,
        int|string $chat_id,
        int $message_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function removeBusinessAccountProfilePhoto(
        string $business_connection_id,
        ?bool $is_public = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function removeChatVerification(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function removeUserVerification(
        int $user_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function refundStarPayment(
        int $user_id,
        string $telegram_payment_charge_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function reopenForumTopic(
        int|string $chat_id,
        int $message_thread_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function reopenGeneralForumTopic(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function replaceStickerInSet(
        int $user_id,
        string $name,
        string $old_sticker,
        InputSticker $sticker,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function repostStory(
        string $business_connection_id,
        int $from_chat_id,
        int $from_story_id,
        int $active_period,
        ?bool $post_to_chat_page = null,
        ?bool $protect_content = null,
    ): Story {
        return Story::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function restrictChatMember(
        int|string $chat_id,
        int $user_id,
        ChatPermissions $permissions,
        ?bool $use_independent_chat_permissions = null,
        ?int $until_date = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function revokeChatInviteLink(
        int|string $chat_id,
        string $invite_link,
    ): ChatInviteLink {
        return ChatInviteLink::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function savePreparedInlineMessage(

        int $user_id,
        InlineQueryResult $result,
        ?bool $allow_user_chats = null,
        ?bool $allow_bot_chats = null,
        ?bool $allow_group_chats = null,
        ?bool $allow_channel_chats = null,
    ): PreparedInlineMessage {
        return PreparedInlineMessage::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
    public function sendChatAction(
        int|string $chat_id,
        string $action,
        ?string $business_connection_id = null,
        ?int $message_thread_id = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function sendChecklist(
        int|string $chat_id,
        InputChecklist $checklist,
        string $business_connection_id,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?string $message_effect_id = null,
        ?ReplyParameters $reply_parameters = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function sendGift(
        string $gift_id,
        ?int $user_id = null,
        int|string|null $chat_id = null,
        ?bool $pay_for_upgrade = null,
        ?string $text = null,
        ?string $text_parse_mode = null,
        ?array $text_entities = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): array {
        return array_map(
            array: $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            callback: Message::fromArray(...),
        );
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function sendMessageDraft(
        int|string $chat_id,
        int $draft_id,
        string $text,
        ?int $message_thread_id = null,
        ?string $parse_mode = null,
        ?array $entities = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
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
    ): Message {
        return Message::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
    public function setBusinessAccountBio(
        string $business_connection_id,
        ?string $bio = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setBusinessAccountGiftSettings(
        string $business_connection_id,
        bool $show_gift_button,
        AcceptedGiftTypes $accepted_gift_types,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setBusinessAccountName(
        string $business_connection_id,
        string $first_name,
        ?string $last_name = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setBusinessAccountProfilePhoto(
        string $business_connection_id,
        InputProfilePhoto $photo,
        ?bool $is_public = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setBusinessAccountUsername(
        string $business_connection_id,
        ?string $username = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setChatAdministratorCustomTitle(
        int|string $chat_id,
        int $user_id,
        string $custom_title,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setChatDescription(
        int|string $chat_id,
        ?string $description = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setChatMenuButton(
        ?int $chat_id = null,
        ?MenuButton $menu_button = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setChatPermissions(
        int|string $chat_id,
        ChatPermissions $permissions,
        ?bool $use_independent_chat_permissions = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setChatPhoto(
        int|string $chat_id,
        InputFile $photo,
    ): bool {
        return $this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars());
    }
    public function setChatStickerSet(
        int|string $chat_id,
        string $sticker_set_name,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setChatTitle(
        int|string $chat_id,
        string $title,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setCustomEmojiStickerSetThumbnail(
        string $name,
        ?string $custom_emoji_id = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setGameScore(
        int $user_id,
        int $score,
        ?bool $force = null,
        ?bool $disable_edit_message = null,
        ?int $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
    ): Message|bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setMessageReaction(

        int|string $chat_id,
        int $message_id,
        ?array $reaction = null,
        ?bool $is_big = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setMyCommands(
        array $commands,
        ?BotCommandScope $scope = null,
        ?string $language_code = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setMyDefaultAdministratorRights(
        ?ChatAdministratorRights $rights = null,
        ?bool $for_channels = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setMyDescription(
        ?string $description = null,
        ?string $language_code = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setMyName(
        ?string $name = null,
        ?string $language_code = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setMyShortDescription(
        ?string $short_description = null,
        ?string $language_code = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setPassportDataErrors(
        int $user_id,
        array $errors,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setStickerEmojiList(
        string $sticker,
        array $emoji_list,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setStickerKeywords(
        string $sticker,
        ?array $keywords = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setStickerMaskPosition(
        string $sticker,
        ?MaskPosition $mask_position = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setStickerPositionInSet(
        string $sticker,
        int $position,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setStickerSetThumbnail(
        string $name,
        int $user_id,
        string $format,
        InputFile|string|null $thumbnail = null,
    ): bool {
        return $this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars());
    }
    public function setStickerSetTitle(
        string $name,
        string $title,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setUserEmojiStatus(
        int $user_id,
        ?string $emoji_status_custom_emoji_id = null,
        ?int $emoji_status_expiration_date = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function setWebhook(
        string $url,
        ?InputFile $certificate = null,
        ?string $ip_address = null,
        ?int $max_connections = null,
        ?array $allowed_updates = null,
        ?bool $drop_pending_updates = null,
        ?string $secret_token = null,
    ): bool {
        return match($certificate === null) {
            true => $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()),
            default => $this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()),
        };
    }
    public function stopMessageLiveLocation(
        ?string $business_connection_id = null,
        int|string|null $chat_id = null,
        ?int $message_id = null,
        ?string $inline_message_id = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Message|bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function stopPoll(
        int|string $chat_id,
        int $message_id,
        ?string $business_connection_id = null,
        ?InlineKeyboardMarkup $reply_markup = null,
    ): Poll {
        return Poll::fromArray($this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars()));
    }
    public function transferBusinessAccountStars(
        string $business_connection_id,
        int $star_count,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function transferGift(
        string $business_connection_id,
        string $owned_gift_id,
        int $new_owner_chat_id,
        ?int $star_count = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function unbanChatMember(
        int|string $chat_id,
        int $user_id,
        ?bool $only_if_banned = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function unbanChatSenderChat(
        int|string $chat_id,
        int $sender_chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function unhideGeneralForumTopic(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function unpinAllChatMessages(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function unpinAllForumTopicMessages(
        int|string $chat_id,
        int $message_thread_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function unpinAllGeneralForumTopicMessages(
        int|string $chat_id,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function unpinChatMessage(
        int|string $chat_id,
        ?string $business_connection_id = null,
        ?int $message_id = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function upgradeGift(
        string $business_connection_id,
        string $owned_gift_id,
        ?bool $keep_original_details = null,
        ?int $star_count = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function uploadStickerFile(
        int $user_id,
        InputFile $sticker,
        string $sticker_format,
    ): File {
        return File::fromArray($this->apiClient->sendMultipartRequest(__FUNCTION__, get_defined_vars()));
    }
    public function verifyChat(
        int|string $chat_id,
        ?string $custom_description = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }
    public function verifyUser(
        int $user_id,
        ?string $custom_description = null,
    ): bool {
        return $this->apiClient->sendJsonRequest(__FUNCTION__, get_defined_vars());
    }

}
