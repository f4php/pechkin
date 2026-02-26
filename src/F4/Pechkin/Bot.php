<?php

declare(strict_types=1);

namespace F4\Pechkin;

use F4\Core\{
    RequestInterface,
    Response,
    ResponseInterface,
};
use F4\Pechkin\{
    BotInterface,
    Client,
    Context,
    RouterTrait,
    DataType\Update,
};

use function json_decode;

class Bot implements BotInterface
{
    use ExceptionHandlerTrait;
    use RouterTrait;
    protected Client $client;

    public function __construct(string $token)
    {
        $this->client = new Client($token);
    }
    public function interceptWebhook(RequestInterface $request): ResponseInterface
    {
        $update = Update::fromArray(json_decode(json: $request->getPsrRequest()->getBody()->getContents(), flags: JSON_THROW_ON_ERROR));
        $this->dispatch(new Context(
            client: $this->client,
            // session: $this->session->fromUpdate($update),
            update: $update,
        ));
        return new Response()
            ->withStatus(204);
    }

    public function requestUpdates(): array
    {
        return [];
    }
}
