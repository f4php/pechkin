<?php

declare(strict_types=1);

namespace F4\Pechkin\Context;

use F4\Pechkin\DataType\{
    Chat,
    MessageReactionUpdated,
    ReactionType,
    User,
};

use function array_filter, array_values, json_encode;

class ReactionContext
{
    public function __construct(
        private readonly MessageReactionUpdated $reaction,
    ) {}

    /**
     * Returns reactions that were added (present in new_reaction but not in old_reaction).
     *
     * @return ReactionType[]
     */
    public function added(): array
    {
        $oldKeys = $this->reactionKeys($this->reaction->old_reaction);

        return array_values(array_filter(
            $this->reaction->new_reaction,
            fn(ReactionType $r) => !isset($oldKeys[$this->reactionKey($r)]),
        ));
    }

    /**
     * Returns reactions that were removed (present in old_reaction but not in new_reaction).
     *
     * @return ReactionType[]
     */
    public function removed(): array
    {
        $newKeys = $this->reactionKeys($this->reaction->new_reaction);

        return array_values(array_filter(
            $this->reaction->old_reaction,
            fn(ReactionType $r) => !isset($newKeys[$this->reactionKey($r)]),
        ));
    }

    public function chat(): Chat
    {
        return $this->reaction->chat;
    }

    public function messageId(): int
    {
        return $this->reaction->message_id;
    }

    public function user(): ?User
    {
        return $this->reaction->user;
    }

    public function actorChat(): ?Chat
    {
        return $this->reaction->actor_chat;
    }

    public function reaction(): MessageReactionUpdated
    {
        return $this->reaction;
    }

    /**
     * @param ReactionType[] $reactions
     * @return array<string, true>
     */
    private function reactionKeys(array $reactions): array
    {
        $keys = [];
        foreach ($reactions as $r) {
            $keys[$this->reactionKey($r)] = true;
        }
        return $keys;
    }

    private function reactionKey(ReactionType $reaction): string
    {
        return json_encode($reaction->toArray(compact: true));
    }
}
