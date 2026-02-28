<?php

declare(strict_types=1);

namespace F4\Pechkin\Context;

use LogicException;
use F4\Pechkin\ClientInterface;
use F4\Pechkin\DataType\{
    CallbackQuery,
    Message,
};

class CallbackContext
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly CallbackQuery $query,
    ) {}

    public function answer(?string $text = null): bool
    {
        return $this->client->answerCallbackQuery(
            callback_query_id: $this->query->id,
            text: $text,
        );
    }

    public function alert(string $text): bool
    {
        return $this->client->answerCallbackQuery(
            callback_query_id: $this->query->id,
            text: $text,
            show_alert: true,
        );
    }

    public function answerUrl(string $url): bool
    {
        return $this->client->answerCallbackQuery(
            callback_query_id: $this->query->id,
            url: $url,
        );
    }

    public function data(): ?string
    {
        return $this->query->data;
    }

    public function edit(string $text): Message|bool
    {
        if ($this->query->message instanceof Message) {
            return $this->client->editMessageText(
                text: $text,
                chat_id: $this->query->message->chat->id,
                message_id: $this->query->message->message_id,
            );
        }

        if ($this->query->inline_message_id !== null) {
            return $this->client->editMessageText(
                text: $text,
                inline_message_id: $this->query->inline_message_id,
            );
        }

        throw new LogicException('Cannot edit: callback query has no accessible message or inline_message_id.');
    }

    public function delete(): bool
    {
        if (!($this->query->message instanceof Message)) {
            throw new LogicException('Cannot delete: callback query message is inaccessible or absent.');
        }

        return $this->client->deleteMessage(
            chat_id: $this->query->message->chat->id,
            message_id: $this->query->message->message_id,
        );
    }

    public function chatId(): ?string
    {
        if ($this->query->message instanceof Message) {
            return $this->query->message->chat->id;
        }

        // InaccessibleMessage still has a chat
        return $this->query->message?->chat->id;
    }

    public function query(): CallbackQuery
    {
        return $this->query;
    }
}
