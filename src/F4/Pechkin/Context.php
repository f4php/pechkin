<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Pechkin\{
    ClientInterface,
    DataType\Update,
};
use F4\Pechkin\Context\{
    CallbackContext,
    InlineContext,
    MembershipContext,
    MessageContext,
    PaymentContext,
    ReactionContext,
    UserContext,
};

class Context
{
    public function __construct(
        public readonly ClientInterface $client,
        public readonly Update $update,
    ) {}
    public function withClient(ClientInterface $client): static
    {
        return clone($this, [
            'client' => $client,
        ]);
    }
    public function withUpdate(Update $update): static
    {
        return clone($this, [
            'update' => $update,
        ]);
    }
    public function message(): ?MessageContext
    {
        $message = $this->update->message
            ?? $this->update->edited_message
            ?? $this->update->channel_post
            ?? $this->update->edited_channel_post
            ?? $this->update->business_message
            ?? $this->update->edited_business_message;

        return $message !== null ? new MessageContext($this->client, $message) : null;
    }
    public function user(): ?UserContext
    {
        $user = $this->update->message?->from
            ?? $this->update->edited_message?->from
            ?? $this->update->channel_post?->from
            ?? $this->update->edited_channel_post?->from
            ?? $this->update->business_message?->from
            ?? $this->update->edited_business_message?->from
            ?? $this->update->business_connection?->user
            ?? $this->update->callback_query?->from
            ?? $this->update->inline_query?->from
            ?? $this->update->chosen_inline_result?->from
            ?? $this->update->shipping_query?->from
            ?? $this->update->pre_checkout_query?->from
            ?? $this->update->my_chat_member?->from
            ?? $this->update->chat_member?->from
            ?? $this->update->chat_join_request?->from
            ?? $this->update->message_reaction?->user
            ?? $this->update->poll_answer?->user;

        return $user !== null ? new UserContext($this->client, $user) : null;
    }
    public function callback(): ?CallbackContext
    {
        return $this->update->callback_query !== null
            ? new CallbackContext($this->client, $this->update->callback_query)
            : null;
    }
    public function inline(): ?InlineContext
    {
        return $this->update->inline_query !== null
            ? new InlineContext($this->client, $this->update->inline_query)
            : null;
    }
    public function payment(): ?PaymentContext
    {
        if ($this->update->shipping_query === null && $this->update->pre_checkout_query === null) {
            return null;
        }
        return new PaymentContext(
            $this->client,
            $this->update->shipping_query,
            $this->update->pre_checkout_query,
        );
    }
    public function membership(): ?MembershipContext
    {
        $memberUpdated = $this->update->my_chat_member ?? $this->update->chat_member;
        $joinRequest = $this->update->chat_join_request;
        if ($memberUpdated === null && $joinRequest === null) {
            return null;
        }
        return new MembershipContext($this->client, $memberUpdated, $joinRequest);
    }
    public function reaction(): ?ReactionContext
    {
        return $this->update->message_reaction !== null
            ? new ReactionContext($this->update->message_reaction)
            : null;
    }
}
