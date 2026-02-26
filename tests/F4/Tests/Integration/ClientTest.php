<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\Client\ClientException;
use F4\Pechkin\DataType\{
    AcceptedGiftTypes,
    BotCommand,
    ChatAdministratorRights,
    ChatFullInfo,
    ChatInviteLink,
    ChatMember,
    ChatPermissions,
    File,
    ForumTopic,
    Gifts,
    InputFile,
    InputSticker,
    InlineKeyboardButton,
    InlineKeyboardMarkup,
    InlineQueryResultArticle,
    Message,
    MessageId,
    MenuButton,
    Poll,
    Sticker,
    StarTransactions,
    Update,
    User,
    UserChatBoosts,
    UserProfilePhotos,
    WebHookInfo,
    BotDescription,
    BotName,
    BotShortDescription,
    StarAmount,
};
use PHPUnit\Framework\Attributes\{
    Depends,
    Group,
};

#[Group('integration')]
final class ClientTest extends IntegrationTestCase
{
    // -------------------------------------------------------------------------
    // Bot info
    // -------------------------------------------------------------------------

    public function testGetMe(): User
    {
        $me = self::$client->getMe();

        $this->assertInstanceOf(User::class, $me);
        $this->assertTrue($me->is_bot);
        $this->assertNotEmpty($me->first_name);

        return $me;
    }

    public function testGetWebhookInfo(): void
    {
        $info = self::$client->getWebhookInfo();
        $this->assertInstanceOf(WebHookInfo::class, $info);
        // url is empty string when no webhook is set — either way it must be a string
        $this->assertIsString($info->url);
    }

    public function testGetMyName(): void
    {
        $name = self::$client->getMyName();
        $this->assertInstanceOf(BotName::class, $name);
        $this->assertNotEmpty($name->name);
    }

    public function testGetMyDescription(): void
    {
        $desc = self::$client->getMyDescription();
        $this->assertInstanceOf(BotDescription::class, $desc);
    }

    public function testGetMyShortDescription(): void
    {
        $desc = self::$client->getMyShortDescription();
        $this->assertInstanceOf(BotShortDescription::class, $desc);
    }

    public function testGetMyDefaultAdministratorRights(): void
    {
        $rights = self::$client->getMyDefaultAdministratorRights();
        $this->assertInstanceOf(ChatAdministratorRights::class, $rights);
    }

    // -------------------------------------------------------------------------
    // Bot settings round-trips
    // -------------------------------------------------------------------------

    public function testSetAndGetMyCommands(): void
    {
        $commands = [new BotCommand('testcmd', 'Integration test command')];

        $set = self::$client->setMyCommands($commands);
        $this->assertTrue($set);

        $got = self::$client->getMyCommands();
        $this->assertIsArray($got);
        $this->assertNotEmpty($got);
        $this->assertInstanceOf(BotCommand::class, $got[0]);

        $last = array_values(array_filter($got, fn($c) => $c->command === 'testcmd'));
        $this->assertCount(1, $last);
        $this->assertSame('Integration test command', $last[0]->description);
    }

    public function testDeleteMyCommands(): void
    {
        $result = self::$client->deleteMyCommands();
        $this->assertTrue($result);

        $got = self::$client->getMyCommands();
        $this->assertIsArray($got);
        $this->assertEmpty($got);
    }

    public function testSetMyDescription(): void
    {
        $result = self::$client->setMyDescription('Integration test bot');
        $this->assertTrue($result);
    }

    public function testSetMyShortDescription(): void
    {
        $result = self::$client->setMyShortDescription('Integration test');
        $this->assertTrue($result);
    }

    public function testSetMyDefaultAdministratorRights(): void
    {
        $result = self::$client->setMyDefaultAdministratorRights();
        $this->assertTrue($result);
    }

    public function testGetChatMenuButton(): void
    {
        $button = self::$client->getChatMenuButton();
        $this->assertInstanceOf(MenuButton::class, $button);
    }

    public function testSetChatMenuButton(): void
    {
        $result = self::$client->setChatMenuButton();
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Sending messages — these are the foundation for all chained tests
    // -------------------------------------------------------------------------

    public function testSendMessage(): Message
    {
        $msg = self::$client->sendMessage(
            chat_id: self::$chatId,
            text: '[integration] testSendMessage',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertSame('[integration] testSendMessage', $msg->text);

        return $msg;
    }

    #[Depends('testSendMessage')]
    public function testEditMessageText(Message $msg): Message
    {
        $edited = self::$client->editMessageText(
            text: '[integration] testEditMessageText',
            chat_id: self::$chatId,
            message_id: $msg->message_id,
        );

        $this->assertInstanceOf(Message::class, $edited);
        $this->assertSame('[integration] testEditMessageText', $edited->text);

        return $edited;
    }

    #[Depends('testEditMessageText')]
    public function testEditMessageReplyMarkup(Message $msg): void
    {
        // Add a button first, then remove it — both calls must succeed
        $markup = new InlineKeyboardMarkup(
            inline_keyboard: [[
                new InlineKeyboardButton(text: 'Test', callback_data: 'test'),
            ]]
        );

        $withMarkup = self::$client->editMessageReplyMarkup(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
            reply_markup: $markup,
        );
        $this->assertInstanceOf(Message::class, $withMarkup);

        $withoutMarkup = self::$client->editMessageReplyMarkup(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
            reply_markup: new InlineKeyboardMarkup(inline_keyboard: []),
        );
        $this->assertInstanceOf(Message::class, $withoutMarkup);
    }

    #[Depends('testSendMessage')]
    public function testForwardMessage(Message $msg): Message
    {
        $fwd = self::$client->forwardMessage(
            chat_id: self::$chatId,
            from_chat_id: self::$chatId,
            message_id: $msg->message_id,
        );

        $this->assertInstanceOf(Message::class, $fwd);

        return $fwd;
    }

    #[Depends('testSendMessage')]
    public function testCopyMessage(Message $msg): MessageId
    {
        $copy = self::$client->copyMessage(
            chat_id: self::$chatId,
            from_chat_id: self::$chatId,
            message_id: $msg->message_id,
        );

        $this->assertInstanceOf(MessageId::class, $copy);
        $this->assertIsInt($copy->message_id);

        return $copy;
    }

    #[Depends('testSendMessage')]
    public function testCopyMessages(Message $msg): void
    {
        $copies = self::$client->copyMessages(
            chat_id: self::$chatId,
            from_chat_id: self::$chatId,
            message_ids: [$msg->message_id],
        );

        $this->assertIsArray($copies);
        $this->assertNotEmpty($copies);
        $this->assertInstanceOf(MessageId::class, $copies[0]);
    }

    #[Depends('testSendMessage')]
    public function testForwardMessages(Message $msg): void
    {
        $fwds = self::$client->forwardMessages(
            chat_id: self::$chatId,
            from_chat_id: self::$chatId,
            message_ids: [$msg->message_id],
        );

        $this->assertIsArray($fwds);
        $this->assertNotEmpty($fwds);
        $this->assertInstanceOf(MessageId::class, $fwds[0]);
    }

    public function testSendDice(): Message
    {
        $msg = self::$client->sendDice(chat_id: self::$chatId);
        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->dice);

        return $msg;
    }

    public function testSendContact(): Message
    {
        $msg = self::$client->sendContact(
            chat_id: self::$chatId,
            phone_number: '+10000000000',
            first_name: 'Integration',
            last_name: 'Test',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->contact);

        return $msg;
    }

    public function testSendLocation(): Message
    {
        $msg = self::$client->sendLocation(
            chat_id: self::$chatId,
            latitude: 55.7558,
            longitude: 37.6173,
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->location);

        return $msg;
    }

    public function testSendVenue(): Message
    {
        $msg = self::$client->sendVenue(
            chat_id: self::$chatId,
            latitude: 55.7558,
            longitude: 37.6173,
            title: 'Integration Test Venue',
            address: '123 Test Street',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->venue);

        return $msg;
    }

    public function testSendPoll(): Message
    {
        $msg = self::$client->sendPoll(
            chat_id: self::$chatId,
            question: 'Integration test poll',
            options: [
                ['text' => 'Option A'],
                ['text' => 'Option B'],
            ],
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->poll);

        return $msg;
    }

    #[Depends('testSendPoll')]
    public function testStopPoll(Message $msg): void
    {
        $poll = self::$client->stopPoll(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
        );

        $this->assertInstanceOf(Poll::class, $poll);
        $this->assertTrue($poll->is_closed);
    }

    // -------------------------------------------------------------------------
    // File uploads (use small inline content)
    // -------------------------------------------------------------------------

    public function testSendPhoto(): Message
    {
        // 1x1 red pixel PNG (smallest valid PNG)
        $png = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8/5+hHgAHggJ/PchI6QAAAABJRU5ErkJggg=='
        );
        $msg = self::$client->sendPhoto(
            chat_id: self::$chatId,
            photo: new InputFile('test.png', $png),
            caption: '[integration] testSendPhoto',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->photo);

        return $msg;
    }

    public function testSendDocument(): Message
    {
        $msg = self::$client->sendDocument(
            chat_id: self::$chatId,
            document: new InputFile('test.txt', '[integration] testSendDocument'),
            caption: '[integration] testSendDocument',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->document);

        return $msg;
    }

    #[Depends('testSendDocument')]
    public function testEditMessageCaption(Message $msg): void
    {
        $result = self::$client->editMessageCaption(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
            caption: '[integration] testEditMessageCaption',
        );

        $this->assertTrue($result === true || $result instanceof Message);
    }

    // -------------------------------------------------------------------------
    // Chat info
    // -------------------------------------------------------------------------

    public function testGetChat(): void
    {
        $chat = self::$client->getChat(self::$chatId);
        $this->assertInstanceOf(ChatFullInfo::class, $chat);
    }

    public function testGetChatMemberCount(): void
    {
        $count = self::$client->getChatMemberCount(self::$chatId);
        $this->assertIsInt($count);
        $this->assertGreaterThan(0, $count);
    }

    public function testGetChatAdministrators(): void
    {
        $admins = self::$client->getChatAdministrators(self::$chatId);
        $this->assertIsArray($admins);
        $this->assertNotEmpty($admins);
        $this->assertInstanceOf(ChatMember::class, $admins[0]);
    }

    public function testGetChatMember(): void
    {
        $member = self::$client->getChatMember(self::$chatId, self::$botId);
        $this->assertInstanceOf(ChatMember::class, $member);
    }

    // -------------------------------------------------------------------------
    // Chat action
    // -------------------------------------------------------------------------

    public function testSendChatAction(): void
    {
        $result = self::$client->sendChatAction(
            chat_id: self::$chatId,
            action: 'typing',
        );
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Pinning
    // -------------------------------------------------------------------------

    public function testPinAndUnpinChatMessage(): void
    {
        $msg = self::$client->sendMessage(
            chat_id: self::$chatId,
            text: '[integration] pin test',
        );

        $pinned = self::$client->pinChatMessage(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
            disable_notification: true,
        );
        $this->assertTrue($pinned);

        $unpinned = self::$client->unpinChatMessage(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
        );
        $this->assertTrue($unpinned);
    }

    public function testUnpinAllChatMessages(): void
    {
        $result = self::$client->unpinAllChatMessages(self::$chatId);
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Message reaction
    // -------------------------------------------------------------------------

    public function testSetMessageReaction(): void
    {
        $msg = self::$client->sendMessage(
            chat_id: self::$chatId,
            text: '[integration] reaction test',
        );

        $result = self::$client->setMessageReaction(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
            reaction: [['type' => 'emoji', 'emoji' => '👍']],
        );
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Delete messages
    // -------------------------------------------------------------------------

    public function testDeleteMessage(): void
    {
        $msg = self::$client->sendMessage(
            chat_id: self::$chatId,
            text: '[integration] to be deleted',
        );

        $result = self::$client->deleteMessage(
            chat_id: self::$chatId,
            message_id: $msg->message_id,
        );
        $this->assertTrue($result);
    }

    public function testDeleteMessages(): void
    {
        $msg1 = self::$client->sendMessage(chat_id: self::$chatId, text: '[integration] delete batch 1');
        $msg2 = self::$client->sendMessage(chat_id: self::$chatId, text: '[integration] delete batch 2');

        $result = self::$client->deleteMessages(
            chat_id: self::$chatId,
            message_ids: [$msg1->message_id, $msg2->message_id],
        );
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Invite links
    // -------------------------------------------------------------------------

    public function testCreateChatInviteLink(): ChatInviteLink
    {
        $link = self::$client->createChatInviteLink(chat_id: self::$chatId);
        $this->assertInstanceOf(ChatInviteLink::class, $link);
        $this->assertNotEmpty($link->invite_link);

        return $link;
    }

    #[Depends('testCreateChatInviteLink')]
    public function testEditChatInviteLink(ChatInviteLink $link): ChatInviteLink
    {
        $edited = self::$client->editChatInviteLink(
            chat_id: self::$chatId,
            invite_link: $link->invite_link,
            name: 'Integration test link',
        );

        $this->assertInstanceOf(ChatInviteLink::class, $edited);

        return $edited;
    }

    #[Depends('testEditChatInviteLink')]
    public function testRevokeChatInviteLink(ChatInviteLink $link): void
    {
        $revoked = self::$client->revokeChatInviteLink(
            chat_id: self::$chatId,
            invite_link: $link->invite_link,
        );

        $this->assertInstanceOf(ChatInviteLink::class, $revoked);
        $this->assertTrue($revoked->is_revoked);
    }

    public function testExportChatInviteLink(): void
    {
        $link = self::$client->exportChatInviteLink(self::$chatId);
        $this->assertIsString($link);
        $this->assertStringStartsWith('https://t.me/', $link);
    }

    // -------------------------------------------------------------------------
    // User profile photos
    // -------------------------------------------------------------------------

    public function testGetUserProfilePhotos(): void
    {
        $photos = self::$client->getUserProfilePhotos(self::$botId);
        $this->assertInstanceOf(UserProfilePhotos::class, $photos);
        $this->assertIsInt($photos->total_count);
    }

    // -------------------------------------------------------------------------
    // File download
    // -------------------------------------------------------------------------

    public function testGetFile(): void
    {
        // Send a document, get its file_id, then call getFile
        $msg = self::$client->sendDocument(
            chat_id: self::$chatId,
            document: new InputFile('getfile_test.txt', 'getFile integration test'),
        );

        $file = self::$client->getFile($msg->document->file_id);
        $this->assertInstanceOf(File::class, $file);
        $this->assertNotEmpty($file->file_id);
    }

    // -------------------------------------------------------------------------
    // Updates (long polling)
    // -------------------------------------------------------------------------

    public function testGetUpdates(): void
    {
        // timeout=0 returns immediately; may return empty array
        $updates = self::$client->getUpdates(timeout: 0, limit: 1);
        $this->assertIsArray($updates);
        foreach ($updates as $update) {
            $this->assertInstanceOf(Update::class, $update);
        }
    }

    // -------------------------------------------------------------------------
    // Stars / payments (read-only endpoints)
    // -------------------------------------------------------------------------

    public function testGetMyStarBalance(): void
    {
        $balance = self::$client->getMyStarBalance();
        $this->assertInstanceOf(StarAmount::class, $balance);
        $this->assertIsInt($balance->amount);
    }

    public function testGetStarTransactions(): void
    {
        $txns = self::$client->getStarTransactions(limit: 10);
        $this->assertInstanceOf(StarTransactions::class, $txns);
    }

    // -------------------------------------------------------------------------
    // Stickers (read-only endpoints)
    // -------------------------------------------------------------------------

    public function testGetForumTopicIconStickers(): void
    {
        $stickers = self::$client->getForumTopicIconStickers();
        $this->assertIsArray($stickers);
        // Could be empty, just ensure no exception and correct types
        foreach ($stickers as $sticker) {
            $this->assertInstanceOf(Sticker::class, $sticker);
        }
    }

    // -------------------------------------------------------------------------
    // Gifts (read-only)
    // -------------------------------------------------------------------------

    public function testGetAvailableGifts(): void
    {
        $gifts = self::$client->getAvailableGifts();
        $this->assertInstanceOf(Gifts::class, $gifts);
    }

    // -------------------------------------------------------------------------
    // Chat boosts
    // -------------------------------------------------------------------------

    // this test returns error for any valid chat_id / user_id {"ok":false,"error_code":400,"description":"Bad Request: PEER_ID_INVALID"}

    // public function testGetUserChatBoosts(): void
    // {
    //     $boosts = self::$client->getUserChatBoosts(
    //         chat_id: self::$chatId,
    //         user_id: self::$botId,
    //     );
    //     $this->assertInstanceOf(UserChatBoosts::class, $boosts);
    // }

    // -------------------------------------------------------------------------
    // Methods that require context not available in tests — assert 4xx API error
    // -------------------------------------------------------------------------

    public function testAnswerCallbackQueryWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->answerCallbackQuery(callback_query_id: 'fake_id_000')
        );
    }

    public function testAnswerInlineQueryWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->answerInlineQuery(inline_query_id: 'fake_id_000', results: [])
        );
    }

    public function testAnswerPreCheckoutQueryWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->answerPreCheckoutQuery(pre_checkout_query_id: 'fake_id_000', ok: true)
        );
    }

    public function testAnswerShippingQueryWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->answerShippingQuery(shipping_query_id: 'fake_id_000', ok: true)
        );
    }

    public function testBanChatMemberWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->banChatMember(chat_id: self::$chatId, user_id: 1)
        );
    }

    public function testUnbanChatMemberWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->unbanChatMember(chat_id: self::$chatId, user_id: 1)
        );
    }

    public function testRestrictChatMemberWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->restrictChatMember(
                chat_id: self::$chatId,
                user_id: 1,
                permissions: ChatPermissions::fromArray([]),
            )
        );
    }

    public function testPromoteChatMemberWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->promoteChatMember(chat_id: self::$chatId, user_id: 1)
        );
    }

    public function testApproveChatJoinRequestWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->approveChatJoinRequest(chat_id: self::$chatId, user_id: 1)
        );
    }

    public function testDeclineChatJoinRequestWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->declineChatJoinRequest(chat_id: self::$chatId, user_id: 1)
        );
    }

    public function testGetStickerSetWithFakeName(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getStickerSet('this_sticker_set_definitely_does_not_exist_xyz123')
        );
    }

    public function testGetFileWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getFile('fake_file_id_000')
        );
    }

    public function testGetGameHighScoresWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getGameHighScores(user_id: 1, chat_id: (int) self::$chatId, message_id: 1)
        );
    }

    public function testRefundStarPaymentWithFakeChargeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->refundStarPayment(user_id: 1, telegram_payment_charge_id: 'fake_charge_id')
        );
    }

    public function testSendInvoiceWithNoProvider(): void
    {
        $this->assertApiError(fn() =>
            self::$client->sendInvoice(
                chat_id: self::$chatId,
                title: 'Test Invoice',
                description: 'Integration test',
                payload: 'test_payload',
                currency: 'USD',
                prices: [['label' => 'Item', 'amount' => 100]],
            )
        );
    }

    public function testSendGameWithFakeName(): void
    {
        $this->assertApiError(fn() =>
            self::$client->sendGame(
                chat_id: (int) self::$chatId,
                game_short_name: 'fake_game_integration_test',
            )
        );
    }

    public function testGetBusinessConnectionWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getBusinessConnection('fake_business_id')
        );
    }

    public function testDeleteBusinessMessagesWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->deleteBusinessMessages(
                business_connection_id: 'fake_business_id',
                message_ids: [1],
            )
        );
    }

    public function testReadBusinessMessageWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->readBusinessMessage(
                business_connection_id: 'fake_business_id',
                chat_id: self::$chatId,
                message_id: 1,
            )
        );
    }

    public function testSetChatAdministratorCustomTitleWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setChatAdministratorCustomTitle(
                chat_id: self::$chatId,
                user_id: 1,
                custom_title: 'Tester',
            )
        );
    }

    public function testBanChatSenderChatWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->banChatSenderChat(
                chat_id: self::$chatId,
                sender_chat_id: 1,
            )
        );
    }

    public function testUnbanChatSenderChatWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->unbanChatSenderChat(
                chat_id: self::$chatId,
                sender_chat_id: 1,
            )
        );
    }

    public function testAddStickerToSetWithFakeSet(): void
    {
        $this->assertApiError(fn() =>
            self::$client->addStickerToSet(
                user_id: self::$botId,
                name: 'fake_set_integration_test_by_bot',
                sticker: InputSticker::fromArray([
                    'sticker' => 'fake_file_id',
                    'format' => 'static',
                    'emoji_list' => ['👍'],
                ]),
            )
        );
    }

    public function testDeleteStickerFromSetWithFakeSticker(): void
    {
        $this->assertApiError(fn() =>
            self::$client->deleteStickerFromSet('fake_sticker_file_id')
        );
    }

    public function testSetStickerEmojiListWithFakeSticker(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setStickerEmojiList('fake_sticker_file_id', ['👍'])
        );
    }

    public function testSetStickerKeywordsWithFakeSticker(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setStickerKeywords('fake_sticker_file_id', ['test'])
        );
    }

    public function testSetStickerMaskPositionWithFakeSticker(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setStickerMaskPosition('fake_sticker_file_id')
        );
    }

    public function testSetStickerPositionInSetWithFakeSticker(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setStickerPositionInSet('fake_sticker_file_id', 0)
        );
    }

    public function testSetStickerSetTitleWithFakeName(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setStickerSetTitle('fake_set_integration_test', 'New Title')
        );
    }

    public function testDeleteStickerSetWithFakeName(): void
    {
        $this->assertApiError(fn() =>
            self::$client->deleteStickerSet('fake_set_integration_test')
        );
    }

    public function testSetCustomEmojiStickerSetThumbnailWithFakeName(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setCustomEmojiStickerSetThumbnail('fake_set_integration_test')
        );
    }

    public function testGetCustomEmojiStickersWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getCustomEmojiStickers(['fake_emoji_id_000'])
        );
    }

    public function testDeleteStoryWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->deleteStory('fake_business_id', 1)
        );
    }

    public function testEditUserStarSubscriptionWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->editUserStarSubscription(
                user_id: 1,
                telegram_payment_charge_id: 'fake_charge_id',
                is_canceled: true,
            )
        );
    }

    public function testGiftPremiumSubscriptionWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->giftPremiumSubscription(
                user_id: 1,
                month_count: 3,
                star_count: 1000,
            )
        );
    }

    public function testSendGiftWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->sendGift(gift_id: 'fake_gift_id', user_id: 1)
        );
    }

    public function testSavePreparedInlineMessageWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->savePreparedInlineMessage(
                user_id: 1,
                result: InlineQueryResultArticle::fromArray([
                    'id' => 'test',
                    'title' => 'Test',
                    'input_message_content' => ['message_text' => 'test'],
                ]),
            )
        );
    }

    public function testVerifyUserWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->verifyUser(user_id: 1)
        );
    }

    public function testRemoveUserVerificationWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->removeUserVerification(user_id: 1)
        );
    }

    public function testVerifyChatWithFakeChat(): void
    {
        $this->assertApiError(fn() =>
            self::$client->verifyChat(chat_id: -1)
        );
    }

    public function testRemoveChatVerificationWithFakeChat(): void
    {
        $this->assertApiError(fn() =>
            self::$client->removeChatVerification(chat_id: -1)
        );
    }

    public function testGetUserGiftsWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getUserGifts(user_id: 1)
        );
    }

    public function testGetChatGiftsWithFakeChat(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getChatGifts(chat_id: -1)
        );
    }

    public function testConvertGiftToStarsWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->convertGiftToStars('fake_business_id', 'fake_gift_id')
        );
    }

    public function testTransferGiftWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->transferGift(
                business_connection_id: 'fake_business_id',
                owned_gift_id: 'fake_gift_id',
                new_owner_chat_id: 1,
            )
        );
    }

    public function testUpgradeGiftWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->upgradeGift('fake_business_id', 'fake_gift_id')
        );
    }

    public function testGetBusinessAccountGiftsWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getBusinessAccountGifts('fake_business_id')
        );
    }

    public function testGetBusinessAccountStarBalanceWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getBusinessAccountStarBalance('fake_business_id')
        );
    }

    public function testTransferBusinessAccountStarsWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->transferBusinessAccountStars('fake_business_id', 1)
        );
    }

    public function testSetBusinessAccountBioWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setBusinessAccountBio('fake_business_id', 'Test bio')
        );
    }

    public function testSetBusinessAccountNameWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setBusinessAccountName('fake_business_id', 'Test')
        );
    }

    public function testSetBusinessAccountUsernameWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setBusinessAccountUsername('fake_business_id')
        );
    }

    public function testSetBusinessAccountGiftSettingsWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setBusinessAccountGiftSettings(
                business_connection_id: 'fake_business_id',
                show_gift_button: true,
                accepted_gift_types: AcceptedGiftTypes::fromArray([
                    'unlimited_gifts' => true,
                    'limited_gifts' => false,
                    'unique_gifts' => false,
                    'premium_subscription' => false,
                    'gifts_from_channels' => false,
                ]),
            )
        );
    }

    public function testRemoveBusinessAccountProfilePhotoWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->removeBusinessAccountProfilePhoto('fake_business_id')
        );
    }

    public function testSetPassportDataErrorsWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setPassportDataErrors(user_id: 1, errors: [])
        );
    }

    public function testApproveSuggestedPostWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->approveSuggestedPost(chat_id: self::$chatId, message_id: 1)
        );
    }

    public function testDeclineSuggestedPostWithFakeId(): void
    {
        $this->assertApiError(fn() =>
            self::$client->declineSuggestedPost(chat_id: self::$chatId, message_id: 1)
        );
    }

    public function testSetUserEmojiStatusWithFakeUser(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setUserEmojiStatus(user_id: 1)
        );
    }

    // -------------------------------------------------------------------------
    // Webhook (tested with no-op values to avoid disrupting the bot)
    // -------------------------------------------------------------------------

    public function testDeleteWebhook(): void
    {
        // Only safe to call if the bot is NOT using webhooks — skip if webhook is set
        $info = self::$client->getWebhookInfo();
        if (!empty($info->url)) {
            $this->markTestSkipped('Bot is using a webhook — skipping deleteWebhook to avoid disruption');
        }

        $result = self::$client->deleteWebhook();
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Forum topics (requires a supergroup with topics enabled — graceful skip)
    // -------------------------------------------------------------------------

    public function testForumTopicLifecycle(): void
    {
        try {
            $topic = self::$client->createForumTopic(
                chat_id: self::$chatId,
                name: 'Integration Test Topic',
            );
        } catch (ClientException $e) {
            $this->markTestSkipped('Chat does not support forum topics: ' . $e->getMessage());
            return;
        }

        $this->assertInstanceOf(ForumTopic::class, $topic);

        self::$client->editForumTopic(
            chat_id: self::$chatId,
            message_thread_id: $topic->message_thread_id,
            name: 'Integration Test Topic (edited)',
        );

        self::$client->closeForumTopic(
            chat_id: self::$chatId,
            message_thread_id: $topic->message_thread_id,
        );

        self::$client->reopenForumTopic(
            chat_id: self::$chatId,
            message_thread_id: $topic->message_thread_id,
        );

        self::$client->deleteForumTopic(
            chat_id: self::$chatId,
            message_thread_id: $topic->message_thread_id,
        );

        // No assertion needed — if we got here without exception, all steps worked
        $this->assertTrue(true);
    }

    public function testGeneralForumTopicOperations(): void
    {
        try {
            self::$client->editGeneralForumTopic(self::$chatId, 'General');
        } catch (ClientException $e) {
            $this->markTestSkipped('Chat does not support general forum topic operations: ' . $e->getMessage());
        }
        $this->assertTrue(true);
    }

    // -------------------------------------------------------------------------
    // Subscription invite links (requires channel — graceful skip)
    // -------------------------------------------------------------------------

    public function testCreateChatSubscriptionInviteLinkFallback(): void
    {
        $this->assertApiError(fn() =>
            self::$client->createChatSubscriptionInviteLink(
                chat_id: self::$chatId,
                subscription_period: 2592000,
                subscription_price: 100,
            )
        );
    }

    // -------------------------------------------------------------------------
    // leaveChat — excluded from running; would remove the bot from the test chat
    // -------------------------------------------------------------------------

    public function testLeaveChatWithFakeChat(): void
    {
        $this->assertApiError(fn() =>
            self::$client->leaveChat(chat_id: -1)
        );
    }
}
