<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure;
use F4\Pechkin\{
    AbstractRoutable,
    Context,
    When,
    DataType\ReactionTypeEmoji,
};

use function
    is_string,
    mb_substr;

final class On extends AbstractRoutable
{
    // ── Escape hatches ───────────────────────────────────────────────────

    public static function default(Closure $handler): static
    {
        return self::rawUpdate($handler);
    }

    public static function rawUpdate(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => true,
            handler: $handler,
            priority: self::PRIORITY_LOWEST,
        );
    }

    public static function update(string $type, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => isset($context->update?->$type),
            handler: $handler,
            priority: self::PRIORITY_LOW,
        );
    }

    // ── Message update types ─────────────────────────────────────────────

    public static function message(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->message !== null
                && $when->test($context->update?->message?->text ?? $context->update?->message?->caption ?? ''),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function editedMessage(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->edited_message !== null
                && $when->test($context->update?->edited_message?->text ?? $context->update?->edited_message?->caption ?? ''),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function channelPost(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->channel_post !== null
                && $when->test($context->update?->channel_post?->text ?? $context->update?->channel_post?->caption ?? ''),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function editedChannelPost(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->edited_channel_post !== null
                && $when->test($context->update?->edited_channel_post?->text ?? $context->update?->edited_channel_post?->caption ?? ''),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    // ── Message entity shortcuts ─────────────────────────────────────────

    public static function command(string|When $when, Closure $handler): static
    {
        if (is_string($when)) {
            $when = When::equals($when);
        }
        return new static(
            matcher: fn(Context $context): bool => self::matchEntity($context, 'bot_command', $when),
            handler: $handler,
            priority: self::PRIORITY_HIGHER,
        );
    }

    public static function mention(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => self::matchEntity($context, 'mention', $when),
            handler: $handler,
            priority: self::PRIORITY_HIGHER,
        );
    }

    public static function hashtag(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => self::matchEntity($context, 'hashtag', $when),
            handler: $handler,
            priority: self::PRIORITY_HIGHER,
        );
    }

    public static function cashtag(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => self::matchEntity($context, 'cashtag', $when),
            handler: $handler,
            priority: self::PRIORITY_HIGHER,
        );
    }

    public static function url(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => self::matchEntity($context, 'url', $when),
            handler: $handler,
            priority: self::PRIORITY_HIGHER,
        );
    }

    public static function email(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => self::matchEntity($context, 'email', $when),
            handler: $handler,
            priority: self::PRIORITY_HIGHER,
        );
    }

    public static function phoneNumber(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => self::matchEntity($context, 'phone_number', $when),
            handler: $handler,
            priority: self::PRIORITY_HIGHER,
        );
    }

    // ── Message content types ────────────────────────────────────────────

    public static function photo(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->photo !== null,
            handler: $handler,
        );
    }

    public static function video(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->video !== null,
            handler: $handler,
        );
    }

    public static function voice(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->voice !== null,
            handler: $handler,
        );
    }

    public static function document(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->document !== null,
            handler: $handler,
        );
    }

    public static function audio(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->audio !== null,
            handler: $handler,
        );
    }

    public static function animation(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->animation !== null,
            handler: $handler,
        );
    }

    public static function sticker(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->sticker !== null,
            handler: $handler,
        );
    }

    public static function location(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->location !== null,
            handler: $handler,
        );
    }

    public static function contact(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->contact !== null,
            handler: $handler,
        );
    }

    public static function dice(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->dice !== null,
            handler: $handler,
        );
    }

    public static function venue(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->venue !== null,
            handler: $handler,
        );
    }

    public static function pollMessage(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->poll !== null,
            handler: $handler,
        );
    }

    public static function invoice(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->invoice !== null,
            handler: $handler,
        );
    }

    // ── Service message events ───────────────────────────────────────────

    public static function newChatTitle(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->message?->new_chat_title !== null
                && $when->test($context->update?->message?->new_chat_title),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function newChatMembers(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->new_chat_members !== null,
            handler: $handler,
        );
    }

    public static function leftChatMember(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->left_chat_member !== null,
            handler: $handler,
        );
    }

    public static function pinnedMessage(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->message?->pinned_message !== null,
            handler: $handler,
        );
    }

    // ── Callback queries ─────────────────────────────────────────────────

    public static function callbackQuery(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->callback_query !== null
                && $when->test($context->update?->callback_query?->data ?? ''),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    // ── Inline mode ──────────────────────────────────────────────────────

    public static function inlineQuery(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->inline_query !== null
                && $when->test($context->update?->inline_query?->query),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function chosenInlineResult(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->chosen_inline_result !== null
                && $when->test($context->update?->chosen_inline_result?->result_id),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    // ── Payments ─────────────────────────────────────────────────────────

    public static function preCheckoutQuery(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->pre_checkout_query !== null
                && $when->test($context->update?->pre_checkout_query?->invoice_payload),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function shippingQuery(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->shipping_query !== null
                && $when->test($context->update?->shipping_query?->invoice_payload),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function successfulPayment(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->message?->successful_payment !== null
                && $when->test($context->update?->message?->successful_payment?->invoice_payload),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    // ── Membership ───────────────────────────────────────────────────────

    public static function myChatMember(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->my_chat_member !== null
                && $when->test($context->update?->my_chat_member?->new_chat_member?->status),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function chatMember(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->chat_member !== null
                && $when->test($context->update?->chat_member?->new_chat_member?->status),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    public static function chatJoinRequest(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->chat_join_request !== null,
            handler: $handler,
        );
    }

    // ── Polls ─────────────────────────────────────────────────────────────

    public static function pollAnswer(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->poll_answer !== null
                && $when->test($context->update?->poll_answer?->poll_id),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    // ── Reactions ────────────────────────────────────────────────────────

    public static function messageReaction(When $when, Closure $handler): static
    {
        return new static(
            matcher: function(Context $context) use ($when): bool {
                if ($context->update?->message_reaction === null) {
                    return false;
                }
                foreach ($context->update?->message_reaction?->new_reaction ?? [] as $reaction) {
                    if ($reaction instanceof ReactionTypeEmoji && $when->test($reaction->emoji)) {
                        return true;
                    }
                }
                return false;
            },
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    // ── Boosts ────────────────────────────────────────────────────────────

    public static function chatBoost(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->chat_boost !== null,
            handler: $handler,
        );
    }

    public static function removedChatBoost(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->removed_chat_boost !== null,
            handler: $handler,
        );
    }

    // ── Business account ─────────────────────────────────────────────────

    public static function businessConnection(Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool => $context->update?->business_connection !== null,
            handler: $handler,
        );
    }

    public static function businessMessage(When $when, Closure $handler): static
    {
        return new static(
            matcher: fn(Context $context): bool =>
                $context->update?->business_message !== null
                && $when->test($context->update?->business_message?->text ?? $context->update?->business_message?->caption ?? ''),
            handler: $handler,
            priority: self::PRIORITY_HIGH,
        );
    }

    // ── Private helpers ───────────────────────────────────────────────────

    protected static function matchEntity(Context $context, string $entityType, When $when): bool
    {
        $message = $context->update?->message
            ?? $context->update?->edited_message
            ?? $context->update?->channel_post
            ?? $context->update?->edited_channel_post
            ?? $context->update?->business_message
            ?? $context->update?->edited_business_message;

        if ($message === null) {
            return false;
        }

        $entities = $message?->entities ?? $message?->caption_entities ?? [];
        $text = $message?->text ?? $message?->caption ?? '';

        foreach ($entities as $entity) {
            if ($entity?->type !== $entityType) {
                continue;
            }
            if ($when->test(mb_substr($text, $entity->offset, $entity->length))) {
                return true;
            }
        }

        return false;
    }
}
