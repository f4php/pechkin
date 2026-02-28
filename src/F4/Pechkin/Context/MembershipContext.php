<?php

declare(strict_types=1);

namespace F4\Pechkin\Context;

use LogicException;
use F4\Pechkin\ClientInterface;
use F4\Pechkin\DataType\{
    Chat,
    ChatJoinRequest,
    ChatMemberUpdated,
    User,
};

class MembershipContext
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly ?ChatMemberUpdated $memberUpdated,
        private readonly ?ChatJoinRequest $joinRequest,
    ) {}

    public function isJoinRequest(): bool
    {
        return $this->joinRequest !== null;
    }

    public function isMemberUpdate(): bool
    {
        return $this->memberUpdated !== null;
    }

    public function chat(): Chat
    {
        return $this->memberUpdated?->chat ?? $this->joinRequest->chat;
    }

    public function from(): User
    {
        return $this->memberUpdated?->from ?? $this->joinRequest->from;
    }

    public function oldStatus(): ?string
    {
        return $this->memberUpdated?->old_chat_member->status;
    }

    public function newStatus(): ?string
    {
        return $this->memberUpdated?->new_chat_member->status;
    }

    public function approve(): bool
    {
        if ($this->joinRequest === null) {
            throw new LogicException('approve() is only available for chat join request updates.');
        }

        return $this->client->approveChatJoinRequest(
            chat_id: $this->joinRequest->chat->id,
            user_id: (int) $this->joinRequest->from->id,
        );
    }

    public function decline(): bool
    {
        if ($this->joinRequest === null) {
            throw new LogicException('decline() is only available for chat join request updates.');
        }

        return $this->client->declineChatJoinRequest(
            chat_id: $this->joinRequest->chat->id,
            user_id: (int) $this->joinRequest->from->id,
        );
    }

    public function memberUpdated(): ?ChatMemberUpdated
    {
        return $this->memberUpdated;
    }

    public function joinRequest(): ?ChatJoinRequest
    {
        return $this->joinRequest;
    }
}
