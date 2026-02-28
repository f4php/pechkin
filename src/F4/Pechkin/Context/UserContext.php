<?php

declare(strict_types=1);

namespace F4\Pechkin\Context;

use F4\Pechkin\ClientInterface;
use F4\Pechkin\DataType\{
    User,
    UserProfilePhotos,
};

class UserContext
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly User $user,
    ) {}

    public function id(): string
    {
        return $this->user->id;
    }

    public function name(): string
    {
        return trim($this->user->first_name . ' ' . ($this->user->last_name ?? ''));
    }

    public function username(): ?string
    {
        return $this->user->username;
    }

    public function mention(): string
    {
        return $this->user->username !== null
            ? '@' . $this->user->username
            : $this->user->first_name;
    }

    public function profilePhotos(): UserProfilePhotos
    {
        return $this->client->getUserProfilePhotos(user_id: (int) $this->user->id);
    }

    public function user(): User
    {
        return $this->user;
    }
}
