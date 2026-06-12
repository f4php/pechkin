<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use PHPUnit\Framework\Attributes\Group;

/**
 * WARNING — destructive session operations.
 *
 * logOut() logs the bot out of the cloud Bot API server: the token cannot be used
 * with api.telegram.org again for ~10 minutes (intended for migrating to a local
 * Bot API server). close() closes the current server instance and rejects further
 * requests for a short period.
 *
 * Both tests are double-gated: the integration:destructive group is never part of
 * the default runs, and TELEGRAM_TEST_ALLOW_DESTRUCTIVE must be set explicitly.
 * Run this suite LAST — nothing else will work afterwards.
 */
#[Group('integration')]
#[Group('integration:destructive')]
final class DestructiveTest extends IntegrationTestCase
{
    protected function setUp(): void
    {
        $this->skipUnlessDestructiveAllowed();
    }

    public function testClose(): void
    {
        // close() may respond 429 "too many requests" if the instance started recently;
        // treat that as feature-unavailable rather than a failure
        $result = $this->attemptOrSkip(fn() => self::$client->close(), 'close');
        $this->assertTrue($result);
    }

    public function testLogOut(): void
    {
        $result = $this->attemptOrSkip(fn() => self::$client->logOut(), 'logOut');
        $this->assertTrue($result);
    }
}
