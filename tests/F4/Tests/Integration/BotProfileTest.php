<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\DataType\{
    InputProfilePhotoStatic,
};
use PHPUnit\Framework\Attributes\Group;

/**
 * Bot profile and webhook lifecycle.
 *
 * Note: setMyProfilePhoto / setBusinessAccountProfilePhoto are sent as JSON, and
 * InputProfilePhotoStatic.photo is an attach:// reference — uploading a new photo
 * therefore cannot succeed through this client yet, so those are smoke tests only.
 */
#[Group('integration')]
#[Group('integration:basic')]
final class BotProfileTest extends IntegrationTestCase
{
    public function testSetMyName(): void
    {
        // re-set the current name: avoids changing visible state and the
        // aggressive flood limits Telegram applies to actual renames
        $current = self::$client->getMyName()->name;

        $result = $this->attemptOrSkip(
            fn() => self::$client->setMyName(name: $current),
            'setMyName',
        );
        $this->assertTrue($result);
    }

    public function testSetMyProfilePhoto(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setMyProfilePhoto(
                photo: new InputProfilePhotoStatic(photo: 'attach://unsupported'),
            )
        );
    }

    public function testRemoveMyProfilePhoto(): void
    {
        // succeeds even when no photo is set; skips if Telegram objects
        $result = $this->attemptOrSkip(
            fn() => self::$client->removeMyProfilePhoto(),
            'removeMyProfilePhoto',
        );
        $this->assertTrue($result);
    }

    public function testWebhookLifecycle(): void
    {
        $info = self::$client->getWebhookInfo();
        if ($info->url !== '') {
            $this->markTestSkipped('A webhook is already configured; not clobbering it');
        }

        $this->assertTrue(self::$client->setWebhook(url: 'https://example.com/pechkin-integration-test'));
        $this->assertSame(
            'https://example.com/pechkin-integration-test',
            self::$client->getWebhookInfo()->url,
        );
        $this->assertTrue(self::$client->deleteWebhook());
        $this->assertSame('', self::$client->getWebhookInfo()->url);
    }

    // -------------------------------------------------------------------------
    // Managed bots — this bot does not manage any, so 4xx smoke tests only
    // -------------------------------------------------------------------------

    public function testGetManagedBotToken(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getManagedBotToken(user_id: self::$botId)
        );
    }

    public function testReplaceManagedBotToken(): void
    {
        $this->assertApiError(fn() =>
            self::$client->replaceManagedBotToken(user_id: self::$botId)
        );
    }

    public function testGetManagedBotAccessSettings(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getManagedBotAccessSettings(user_id: self::$botId)
        );
    }

    public function testSetManagedBotAccessSettings(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setManagedBotAccessSettings(
                user_id: self::$botId,
                is_access_restricted: true,
            )
        );
    }
}
