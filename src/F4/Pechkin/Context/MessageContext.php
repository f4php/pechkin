<?php

declare(strict_types=1);

namespace F4\Pechkin\Context;

use F4\Pechkin\ClientInterface;
use F4\Pechkin\DataType\{
    Message,
    ReplyParameters,
};

class MessageContext
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly Message $message,
    ) {}

    public function reply(string $text): Message
    {
        return $this->client->sendMessage(
            chat_id: $this->message->chat->id,
            text: $text,
        );
    }

    public function replyToMessage(string $text): Message
    {
        return $this->client->sendMessage(
            chat_id: $this->message->chat->id,
            text: $text,
            reply_parameters: new ReplyParameters(message_id: $this->message->message_id),
        );
    }

    public function typing(): bool
    {
        return $this->client->sendChatAction(
            chat_id: $this->message->chat->id,
            action: 'typing',
        );
    }

    public function action(string $action): bool
    {
        return $this->client->sendChatAction(
            chat_id: $this->message->chat->id,
            action: $action,
        );
    }

    public function delete(): bool
    {
        return $this->client->deleteMessage(
            chat_id: $this->message->chat->id,
            message_id: $this->message->message_id,
        );
    }

    public function forward(int|string $toChatId): Message
    {
        return $this->client->forwardMessage(
            chat_id: $toChatId,
            from_chat_id: $this->message->chat->id,
            message_id: $this->message->message_id,
        );
    }

    public function pin(): bool
    {
        return $this->client->pinChatMessage(
            chat_id: $this->message->chat->id,
            message_id: $this->message->message_id,
        );
    }

    public function text(): ?string
    {
        return $this->message->text ?? $this->message->caption;
    }

    public function chatId(): string
    {
        return $this->message->chat->id;
    }

    public function threadId(): ?int
    {
        return $this->message->message_thread_id;
    }

    public function message(): Message
    {
        return $this->message;
    }
}
