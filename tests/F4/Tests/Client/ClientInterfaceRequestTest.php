<?php

declare(strict_types=1);

namespace F4\Tests\Client;

use F4\Pechkin\{
    Client,
    ClientInterface,
};
use F4\Pechkin\DataType\{
    EphemeralMessageParameters,
    InputRichMessage,
    Message,
};
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

use function json_decode;
use function json_encode;

/**
 * Exercises parameters that ClientInterface used to be missing (or declared
 * differently from Client), calling through the interface type with named
 * arguments the way library consumers do.
 */
final class ClientInterfaceRequestTest extends TestCase
{
    private MockHandler $mockHandler;

    private function client(mixed $result = true): ClientInterface
    {
        $this->mockHandler = new MockHandler([
            new Response(200, [], json_encode(['ok' => true, 'result' => $result])),
        ]);
        return new Client('TEST:TOKEN', new MockableApiClient($this->mockHandler));
    }

    /** @return array{string, array<string, mixed>} */
    private function lastRequest(): array
    {
        $request = $this->mockHandler->getLastRequest();
        $this->assertNotNull($request);
        return [
            $request->getUri()->getPath(),
            json_decode((string) $request->getBody(), true),
        ];
    }

    public function testEditEphemeralMessageCaptionSendsShowCaptionAboveMedia(): void
    {
        $this->assertTrue($this->client()->editEphemeralMessageCaption(
            chat_id: 1,
            receiver_user_id: 2,
            ephemeral_message_id: 3,
            caption: 'caption',
            show_caption_above_media: true,
        ));
        [$path, $body] = $this->lastRequest();
        $this->assertStringEndsWith('/editEphemeralMessageCaption', $path);
        $this->assertSame(true, $body['show_caption_above_media']);
        $this->assertSame('caption', $body['caption']);
    }

    public function testEditEphemeralMessageTextAcceptsRichMessageWithoutText(): void
    {
        $this->assertTrue($this->client()->editEphemeralMessageText(
            chat_id: 1,
            receiver_user_id: 2,
            ephemeral_message_id: 3,
            rich_message: new InputRichMessage(markdown: '**bold**'),
        ));
        [, $body] = $this->lastRequest();
        $this->assertArrayNotHasKey('text', $body);
        $this->assertSame(['markdown' => '**bold**'], $body['rich_message']);
    }

    public function testEditMessageTextAcceptsRichMessage(): void
    {
        $this->assertTrue($this->client()->editMessageText(
            inline_message_id: 'inline',
            rich_message: new InputRichMessage(html: '<b>bold</b>'),
        ));
        [, $body] = $this->lastRequest();
        $this->assertSame(['html' => '<b>bold</b>'], $body['rich_message']);
    }

    public function testSendMessageSendsEphemeralMessageParameters(): void
    {
        $message = $this->client([
            'message_id' => 10,
            'date' => 1700000000,
            'chat' => ['id' => 1, 'type' => 'private'],
        ])->sendMessage(
            chat_id: 1,
            text: 'hello',
            ephemeral_message_parameters: new EphemeralMessageParameters(
                receiver_user_id: '2',
                callback_query_id: 'cq',
            ),
        );
        $this->assertInstanceOf(Message::class, $message);
        [, $body] = $this->lastRequest();
        $this->assertSame(['receiver_user_id' => '2', 'callback_query_id' => 'cq'], $body['ephemeral_message_parameters']);
        $this->assertArrayNotHasKey('receiver_user_id', $body);
        $this->assertArrayNotHasKey('callback_query_id', $body);
    }

    public function testSendRichMessageDraftSendsStopOptions(): void
    {
        $this->assertTrue($this->client()->sendRichMessageDraft(
            chat_id: 1,
            draft_id: 5,
            rich_message: new InputRichMessage(markdown: 'partial'),
            can_stop: true,
            keep_on_stop: false,
        ));
        [$path, $body] = $this->lastRequest();
        $this->assertStringEndsWith('/sendRichMessageDraft', $path);
        $this->assertSame(true, $body['can_stop']);
        $this->assertSame(false, $body['keep_on_stop']);
    }

    public function testSendMessageDraftSendsStopOptions(): void
    {
        $this->assertTrue($this->client()->sendMessageDraft(
            chat_id: 1,
            draft_id: 5,
            text: '',
            can_stop: true,
            keep_on_stop: true,
        ));
        [, $body] = $this->lastRequest();
        $this->assertSame(true, $body['can_stop']);
        $this->assertSame(true, $body['keep_on_stop']);
    }

    public function testGetChatAdministratorsSendsReturnBots(): void
    {
        $this->assertSame([], $this->client([])->getChatAdministrators(chat_id: 1, return_bots: true));
        [, $body] = $this->lastRequest();
        $this->assertSame(true, $body['return_bots']);
    }

    public function testPromoteChatMemberSendsCanSendWelcomeMessages(): void
    {
        $this->assertTrue($this->client()->promoteChatMember(chat_id: 1, user_id: 2, can_send_welcome_messages: true));
        [, $body] = $this->lastRequest();
        $this->assertSame(true, $body['can_send_welcome_messages']);
    }

    public function testAnswerChatJoinRequestQuery(): void
    {
        $this->assertTrue($this->client()->answerChatJoinRequestQuery(chat_join_request_query_id: 'q', result: 'approve'));
        [$path, $body] = $this->lastRequest();
        $this->assertStringEndsWith('/answerChatJoinRequestQuery', $path);
        $this->assertSame(['chat_join_request_query_id' => 'q', 'result' => 'approve'], $body);
    }

    public function testSendChatJoinRequestWebApp(): void
    {
        $this->assertTrue($this->client()->sendChatJoinRequestWebApp(chat_join_request_query_id: 'q', web_app_url: 'https://example.com'));
        [$path, $body] = $this->lastRequest();
        $this->assertStringEndsWith('/sendChatJoinRequestWebApp', $path);
        $this->assertSame(['chat_join_request_query_id' => 'q', 'web_app_url' => 'https://example.com'], $body);
    }
}
