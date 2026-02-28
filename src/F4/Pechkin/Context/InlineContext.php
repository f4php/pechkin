<?php

declare(strict_types=1);

namespace F4\Pechkin\Context;

use F4\Pechkin\ClientInterface;
use F4\Pechkin\DataType\InlineQuery;

class InlineContext
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly InlineQuery $inlineQuery,
    ) {}

    public function query(): string
    {
        return $this->inlineQuery->query;
    }

    public function answer(array $results): bool
    {
        return $this->client->answerInlineQuery(
            inline_query_id: $this->inlineQuery->id,
            results: $results,
        );
    }

    public function chatType(): ?string
    {
        return $this->inlineQuery->chat_type;
    }

    public function inlineQuery(): InlineQuery
    {
        return $this->inlineQuery;
    }
}
