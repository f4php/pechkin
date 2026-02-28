<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Core\{
    RequestInterface,
    ResponseInterface,
};
use F4\Pechkin\{
    RouterInterface,
    DataType\InputFile,
};

interface BotInterface extends RouterInterface
{
    public function deleteWebhook(): bool;
    public function getWebhookConfig(): array;
    public function getUpdates(): ResponseInterface;
    public function interceptWebhook(RequestInterface $request): ResponseInterface;
    public function registerWebhook(
        string $url,
        ?string $certificatePath = null,
        ?string $address = null,
        ?int $maxConnections = null,
        ?array $allowedUpdates = null,
        ?bool $dropPendingUpdates = null,
    ): bool;
}
