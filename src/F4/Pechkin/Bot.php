<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure,
    RuntimeException,
    SessionHandlerInterface,
    Throwable;
use F4\Core\{
    RequestInterface,
    Response,
    ResponseInterface,
    Exception\HttpException,
};
use F4\Pechkin\{
    BotInterface,
    Client,
    Context,
    RouterTrait,
    DataType\InputFile,
    DataType\Update,
};
use function
    session_id,
    session_set_save_handler,
    session_start,
    session_status,
    session_write_close
    ;

class Bot implements BotInterface
{
    use ExceptionHandlerTrait;
    use RouterTrait;
    protected Client $client;
    protected Closure $sessionKeyResolver;
    protected const int DEFAULT_SESSION_LIFETIME = 365 * 24 * 60 * 60; // default session lifetime is a year

    public function __construct(
        string $token,
        protected int $sessionLifeTime = self::DEFAULT_SESSION_LIFETIME,
        protected ?string $secretToken = null,
        ?Closure $sessionKeyResolver = null,
        ?SessionHandlerInterface $sessionHandler = null,
    )
    {
        $this->client = new Client($token);
        if ($sessionHandler !== null) {
            if(false === session_set_save_handler($sessionHandler, true)) {
                throw new RuntimeException('Failed to set session save handler');
            }
        }
        $this->sessionKeyResolver = $sessionKeyResolver ?? $this->resolveSessionKey(...);
    }
    public function deleteWebhook(): bool
    {
        return $this->client->deleteWebhook();
    }
    protected function endSession(?string $previousSessionId = null): void
    {
        session_write_close();
        // Restore previous session if there was one
        if ($previousSessionId !== null) {
            session_id($previousSessionId);
            session_start();
        }
    }
    public function getUpdates(): ResponseInterface
    {
        throw new RuntimeException('Not implemented yet');
    }
    public function getWebhookConfig(): array
    {
        return $this->client->getWebhookInfo()->toArray();
    }
    public function interceptWebhook(RequestInterface $request): ResponseInterface
    {
        if($this->secretToken !== null) {
            if($request->getPsrRequest()->getHeaderLine('X-Telegram-Bot-Api-Secret-Token') !== $this->secretToken) {
                throw new HttpException('Unauthorized', 403);
            }
        }
        $update = Update::fromArray($request->getParameters());
        $key    = ($this->sessionKeyResolver)($update);
        $previousSessionId = $this->startSession($key);
        $context = new Context(
            client:  $this->client,
            update:  $update,
        );
        try {
            $this->dispatch($context);
        } catch (Throwable $e) {
            $this->processException($e, $context);
        }
        finally {
            $this->endSession($previousSessionId);
            return new Response()
                ->withStatus(204);
        }
    }
    public function registerWebhook(
        string $url,
        ?string $certificatePath = null,
        ?string $address = null,
        ?int $maxConnections = null,
        ?array $allowedUpdates = null,
        ?bool $dropPendingUpdates = null,
    ): bool
    {
        $certificate = match($certificatePath !== null) {
            true => new InputFile(
                'certificate.pem',
                file_get_contents(realpath($certificatePath)),
            ),
            default => null,
        };
        return $this->client->setWebhook(
            url: $url,
            certificate: $certificate,
            ip_address: $address,
            max_connections: $maxConnections,
            allowed_updates: $allowedUpdates,
            drop_pending_updates: $dropPendingUpdates,
            secret_token: $this->secretToken,
        );
    }
    protected function resolveSessionKey(Update $update): string
    {
        // Resolve the chat, if any
        $chat = $update->message?->chat
            ?? $update->edited_message?->chat
            ?? $update->channel_post?->chat
            ?? $update->edited_channel_post?->chat
            ?? $update->business_message?->chat
            ?? $update->edited_business_message?->chat
            ?? $update->callback_query?->message?->chat
            ?? $update->my_chat_member?->chat
            ?? $update->chat_member?->chat
            ?? $update->chat_join_request?->chat
            ?? $update->chat_boost?->chat
            ?? $update->removed_chat_boost?->chat
            ?? $update->message_reaction?->chat
            ?? $update->message_reaction_count?->chat;

        // Non-private chat → key on the chat so all members share the session
        if ($chat !== null && $chat->type !== 'private') {
            return "chat-{$chat->id}";
        }

        // Private chat or no chat context → key on the user
        $userId = $update->message?->from?->id
            ?? $update->edited_message?->from?->id
            ?? $update->channel_post?->from?->id
            ?? $update->edited_channel_post?->from?->id
            ?? $update->business_message?->from?->id
            ?? $update->edited_business_message?->from?->id
            ?? $update->business_connection?->user?->id
            ?? $update->callback_query?->from?->id
            ?? $update->inline_query?->from?->id
            ?? $update->chosen_inline_result?->from?->id
            ?? $update->shipping_query?->from?->id
            ?? $update->pre_checkout_query?->from?->id
            ?? $update->my_chat_member?->from?->id
            ?? $update->chat_member?->from?->id
            ?? $update->chat_join_request?->from?->id
            ?? $update->message_reaction?->user?->id
            ?? $update->poll_answer?->user?->id
            ?? null;

        return $userId !== null ? "user-{$userId}" : null;

    }
    protected function startSession(string $key): ?string
    {
        $previousSessionId = session_id();
        $previousSessionStatus = session_status();
        if ($previousSessionStatus === PHP_SESSION_ACTIVE) {
            session_write_close();
        }
        session_id($key);
        session_start([
            'use_cookies'      => false,
            // 'use_only_cookies' => false,
            // 'cookie_lifetime'  => 0,
            'gc_maxlifetime'   => $this->sessionLifeTime,
        ]);
        return match($previousSessionStatus) {
            PHP_SESSION_ACTIVE => $previousSessionId ?: null,
            default => null,
        };
    }
}
