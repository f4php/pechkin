<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Core\{
    RequestInterface,
    ResponseInterface,
};
use F4\Pechkin\RouterInterface;

interface BotInterface extends RouterInterface
{
    public function interceptWebhook(RequestInterface $request): ResponseInterface;
    public function requestUpdates(): array;
}
