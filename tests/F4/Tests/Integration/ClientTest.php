<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\Client\ClientException;
use F4\Pechkin\DataType\{
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
    InlineKeyboardButton,
    InlineKeyboardMarkup,
    InlineQueryResultArticle,
    Message,
    MessageId,
    MenuButton,
    OwnedGifts,
    Poll,
    Sticker,
    Update,
    User,
    UserChatBoosts,
    UserProfilePhotos,
    WebHookInfo,
    BotDescription,
    BotName,
    BotShortDescription,
    StarAmount,
    StarTransactions,
};
use PHPUnit\Framework\Attributes\{
    Depends,
    Group,
};

#[Group('integration:basic')]
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
    // Sending messages — foundation for all chained tests
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
        // 1x1 red pixel PNG
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
        $updates = self::$client->getUpdates(timeout: 0, limit: 1);
        $this->assertIsArray($updates);
        foreach ($updates as $update) {
            $this->assertInstanceOf(Update::class, $update);
        }
    }

    // -------------------------------------------------------------------------
    // Stars (read-only)
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
    // Stickers (read-only system endpoints)
    // -------------------------------------------------------------------------

    public function testGetForumTopicIconStickers(): void
    {
        $stickers = self::$client->getForumTopicIconStickers();
        $this->assertIsArray($stickers);
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

    public function testGetUserChatBoosts(): void
    {
        // Requires a real human user — bots cannot have boosts
        $this->skipUnlessUserId();

        $boosts = self::$client->getUserChatBoosts(
            chat_id: self::$chatId,
            user_id: self::$userId,
        );
        $this->assertInstanceOf(UserChatBoosts::class, $boosts);
        // boosts array may be empty if the user hasn't boosted the chat
        $this->assertIsArray($boosts->boosts);
    }

    // -------------------------------------------------------------------------
    // Member management lifecycle (requires TELEGRAM_TEST_USER_ID)
    // restrict → promote → set custom title → ban → unban
    // All steps run in one test to guarantee the user is restored afterward.
    // -------------------------------------------------------------------------

    public function testMemberManagementLifecycle(): void
    {
        $this->skipUnlessUserId();

        // Restrict: remove send_messages permission
        $restricted = self::$client->restrictChatMember(
            chat_id: self::$chatId,
            user_id: self::$userId,
            permissions: ChatPermissions::fromArray(['can_send_messages' => false]),
        );
        $this->assertTrue($restricted);

        // Restore full permissions
        $unrestricted = self::$client->restrictChatMember(
            chat_id: self::$chatId,
            user_id: self::$userId,
            permissions: ChatPermissions::fromArray(['can_send_messages' => true]),
        );
        $this->assertTrue($unrestricted);

        // Promote to admin (minimal rights)
        $promoted = self::$client->promoteChatMember(
            chat_id: self::$chatId,
            user_id: self::$userId,
            can_change_info: false,
        );
        $this->assertTrue($promoted);

        // Set a custom title on the promoted admin
        $titled = self::$client->setChatAdministratorCustomTitle(
            chat_id: self::$chatId,
            user_id: self::$userId,
            custom_title: 'Tester',
        );
        $this->assertTrue($titled);

        // Demote back to member (promote with all false)
        self::$client->promoteChatMember(
            chat_id: self::$chatId,
            user_id: self::$userId,
        );

        // Ban then immediately unban (only_if_banned=false so it always succeeds)
        $banned = self::$client->banChatMember(
            chat_id: self::$chatId,
            user_id: self::$userId,
        );
        $this->assertTrue($banned);

        $unbanned = self::$client->unbanChatMember(
            chat_id: self::$chatId,
            user_id: self::$userId,
            only_if_banned: true,
        );
        $this->assertTrue($unbanned);
    }

    // -------------------------------------------------------------------------
    // User gifts (requires TELEGRAM_TEST_USER_ID)
    // -------------------------------------------------------------------------

    public function testGetUserGifts(): void
    {
        $this->skipUnlessUserId();

        $gifts = self::$client->getUserGifts(user_id: self::$userId);
        $this->assertInstanceOf(OwnedGifts::class, $gifts);
        // gifts array may be empty — just verify the response deserializes correctly
        $this->assertIsArray($gifts->gifts);
    }

    // -------------------------------------------------------------------------
    // savePreparedInlineMessage (requires TELEGRAM_TEST_USER_ID)
    // The user must have started the bot in private for this to succeed;
    // we assert a 4xx which proves the request was serialized correctly.
    // -------------------------------------------------------------------------

    public function testSavePreparedInlineMessage(): void
    {
        $this->skipUnlessUserId();

        $this->assertApiError(fn() =>
            self::$client->savePreparedInlineMessage(
                user_id: self::$userId,
                result: InlineQueryResultArticle::fromArray([
                    'id' => 'test',
                    'title' => 'Test',
                    'input_message_content' => ['message_text' => 'test'],
                ]),
            )
        );
    }

    // -------------------------------------------------------------------------
    // Join request operations (requires TELEGRAM_TEST_USER_ID)
    // The user is already a member, so these return 400 — but the request
    // reaches Telegram correctly with a real user_id.
    // -------------------------------------------------------------------------

    public function testApproveChatJoinRequest(): void
    {
        $this->skipUnlessUserId();

        // User is already a member — Telegram returns 400; that proves the call is wired correctly
        $this->assertApiError(fn() =>
            self::$client->approveChatJoinRequest(chat_id: self::$chatId, user_id: self::$userId)
        );
    }

    public function testDeclineChatJoinRequest(): void
    {
        $this->skipUnlessUserId();

        $this->assertApiError(fn() =>
            self::$client->declineChatJoinRequest(chat_id: self::$chatId, user_id: self::$userId)
        );
    }

    // -------------------------------------------------------------------------
    // Verification (bot needs special Telegram grant — assert 400 with real user)
    // -------------------------------------------------------------------------

    public function testVerifyUser(): void
    {
        $this->skipUnlessUserId();

        // Bot doesn't have verification privileges — 400 proves the call is correct
        $this->assertApiError(fn() =>
            self::$client->verifyUser(user_id: self::$userId)
        );
    }

    public function testRemoveUserVerification(): void
    {
        $this->skipUnlessUserId();

        $this->assertApiError(fn() =>
            self::$client->removeUserVerification(user_id: self::$userId)
        );
    }

    // -------------------------------------------------------------------------
    // Webhook
    // -------------------------------------------------------------------------

    public function testDeleteWebhook(): void
    {
        $info = self::$client->getWebhookInfo();
        if (!empty($info->url)) {
            $this->markTestSkipped('Bot is using a webhook — skipping deleteWebhook to avoid disruption');
        }

        $result = self::$client->deleteWebhook();
        $this->assertTrue($result);
    }

    // -------------------------------------------------------------------------
    // Forum topics (requires supergroup with topics enabled — graceful skip)
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

        $unpin = self::$client->unpinAllForumTopicMessages(
            chat_id: self::$chatId,
            message_thread_id: $topic->message_thread_id,
        );
        $this->assertTrue($unpin);

        self::$client->deleteForumTopic(
            chat_id: self::$chatId,
            message_thread_id: $topic->message_thread_id,
        );

        $this->assertTrue(true);
    }

    public function testGeneralForumTopicOperations(): void
    {
        try {
            self::$client->editGeneralForumTopic(self::$chatId, 'General');
        } catch (ClientException $e) {
            $this->markTestSkipped('Chat does not support general forum topic operations: ' . $e->getMessage());
            return;
        }

        self::$client->closeGeneralForumTopic(self::$chatId);
        self::$client->reopenGeneralForumTopic(self::$chatId);
        self::$client->unpinAllGeneralForumTopicMessages(self::$chatId);
        self::$client->hideGeneralForumTopic(self::$chatId);
        self::$client->unhideGeneralForumTopic(self::$chatId);

        $this->assertTrue(true);
    }

    // -------------------------------------------------------------------------
    // leaveChat — use a fake chat to test serialization without leaving the test chat
    // -------------------------------------------------------------------------

    public function testLeaveChatWithFakeChat(): void
    {
        $this->assertApiError(fn() =>
            self::$client->leaveChat(chat_id: -1)
        );
    }

    // -------------------------------------------------------------------------
    // Methods that require live user interactions and cannot be made into
    // real round-trips. These verify the serialization path reaches Telegram
    // and gets a well-formed 4xx back (not a local crash).
    // -------------------------------------------------------------------------

    /**
     * callback_query_id is ephemeral — generated only when a real user presses
     * an inline button. Cannot be pre-created.
     */
    public function testAnswerCallbackQuery(): void
    {
        $this->assertApiError(fn() =>
            self::$client->answerCallbackQuery(callback_query_id: 'fake_id_000')
        );
    }

    /**
     * inline_query_id is ephemeral — generated only when a real user types
     * @botname in any chat.
     */
    public function testAnswerInlineQuery(): void
    {
        $this->assertApiError(fn() =>
            self::$client->answerInlineQuery(inline_query_id: 'fake_id_000', results: [])
        );
    }

    /**
     * pre_checkout_query_id is generated only during an active checkout flow
     * initiated by a real user.
     */
    public function testAnswerPreCheckoutQuery(): void
    {
        $this->assertApiError(fn() =>
            self::$client->answerPreCheckoutQuery(pre_checkout_query_id: 'fake_id_000', ok: true)
        );
    }

    /**
     * shipping_query_id is generated only when a real user fills in a shipping
     * address during an invoice flow.
     */
    public function testAnswerShippingQuery(): void
    {
        $this->assertApiError(fn() =>
            self::$client->answerShippingQuery(shipping_query_id: 'fake_id_000', ok: true)
        );
    }

    /**
     * Games require registration with @BotFather; high scores require live play.
     */
    public function testGetGameHighScores(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getGameHighScores(user_id: 1, chat_id: (int) self::$chatId, message_id: 1)
        );
    }

    /**
     * sendGame requires a game short name registered with @BotFather.
     */
    public function testSendGame(): void
    {
        $this->assertApiError(fn() =>
            self::$client->sendGame(
                chat_id: (int) self::$chatId,
                game_short_name: 'fake_game_integration_test',
            )
        );
    }

    /**
     * Telegram Passport requires a real user who submitted passport data
     * to the bot via a Passport authorization request.
     */
    public function testSetPassportDataErrors(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setPassportDataErrors(user_id: 1, errors: [])
        );
    }

    /**
     * Suggested posts are submitted by real users to a channel.
     */
    public function testApproveSuggestedPost(): void
    {
        $this->assertApiError(fn() =>
            self::$client->approveSuggestedPost(chat_id: self::$chatId, message_id: 1)
        );
    }

    public function testDeclineSuggestedPost(): void
    {
        $this->assertApiError(fn() =>
            self::$client->declineSuggestedPost(chat_id: self::$chatId, message_id: 1)
        );
    }

    /**
     * sender_chat_id must be a real channel that posted a message in the group.
     */
    public function testBanChatSenderChat(): void
    {
        $this->assertApiError(fn() =>
            self::$client->banChatSenderChat(chat_id: self::$chatId, sender_chat_id: 1)
        );
    }

    public function testUnbanChatSenderChat(): void
    {
        $this->assertApiError(fn() =>
            self::$client->unbanChatSenderChat(chat_id: self::$chatId, sender_chat_id: 1)
        );
    }

    /**
     * Verification privileges must be granted by Telegram to the bot.
     */
    public function testVerifyChat(): void
    {
        $this->assertApiError(fn() =>
            self::$client->verifyChat(chat_id: -1)
        );
    }

    public function testRemoveChatVerification(): void
    {
        $this->assertApiError(fn() =>
            self::$client->removeChatVerification(chat_id: -1)
        );
    }

    /**
     * User must have authorized the bot to set their emoji status via a
     * dedicated user-consent flow — not automatable.
     */
    public function testSetUserEmojiStatus(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setUserEmojiStatus(user_id: 1)
        );
    }

    /**
     * sticker set / custom emoji: moved to StickerLifecycleTest.
     * Business account methods: moved to BusinessClientTest.
     * Payment methods: moved to PaymentsClientTest.
     */
}
