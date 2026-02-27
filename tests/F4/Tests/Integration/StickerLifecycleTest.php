<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\DataType\{
    File,
    InputFile,
    InputSticker,
    Sticker,
    StickerSet,
};
use PHPUnit\Framework\Attributes\{
    Depends,
    Group,
};

/**
 * Full sticker set lifecycle: upload → create → inspect → modify → delete.
 *
 * Requires:
 *   TELEGRAM_BOT_TOKEN        — the bot token
 *   TELEGRAM_TEST_CHAT_ID     — a chat the bot is in (only used for base class setup)
 *   TELEGRAM_TEST_USER_ID     — a real Telegram user who will own the sticker set
 *
 * The sticker set is deleted at the end of the suite so no permanent state is left.
 */
#[Group('integration:basic')]
final class StickerLifecycleTest extends IntegrationTestCase
{
    /**
     * 100×100 white PNG — smallest size Telegram accepts for stickers.
     * Generated with: convert -size 100x100 xc:white test.png | base64
     */
    private static function stickerPng(): string
    {
        // 100x100 white PNG (base64-encoded)
        return base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAAIklEQVR4nO3BMQEAAADCoPVP' .
            '7WsIoAAAAAAAAAAAAAAAeAMBxAABHQAAAABJRU5ErkJggg=='
        );
    }

    private static function stickerSetName(): string
    {
        // Telegram requires set name to end with _by_<bot_username> (case-insensitive)
        // and contain only a-z, 0-9 and underscores.
        return 'integrationtest_by_' . strtolower(self::$client->getMe()->username ?? 'bot');
    }

    // -------------------------------------------------------------------------

    public function testUploadStickerFile(): File
    {
        $this->skipUnlessUserId();

        $file = self::$client->uploadStickerFile(
            user_id: self::$userId,
            sticker: new InputFile('sticker.png', self::stickerPng()),
            sticker_format: 'static',
        );

        $this->assertInstanceOf(File::class, $file);
        $this->assertNotEmpty($file->file_id);

        return $file;
    }

    #[Depends('testUploadStickerFile')]
    public function testCreateNewStickerSet(File $file): string
    {
        $this->skipUnlessUserId();

        $name = self::stickerSetName();

        // Delete any leftover set from a previous failed run
        try {
            self::$client->deleteStickerSet($name);
        } catch (\F4\Pechkin\Client\ClientException) {
            // Set didn't exist — that's fine
        }

        $result = self::$client->createNewStickerSet(
            user_id: self::$userId,
            name: $name,
            title: 'Pechkin Integration Test',
            stickers: [
                InputSticker::fromArray([
                    'sticker' => $file->file_id,
                    'format' => 'static',
                    'emoji_list' => ['👍'],
                ]),
            ],
        );

        $this->assertTrue($result);

        return $name;
    }

    #[Depends('testCreateNewStickerSet')]
    public function testGetStickerSet(string $name): StickerSet
    {
        $this->skipUnlessUserId();

        $set = self::$client->getStickerSet($name);

        $this->assertInstanceOf(StickerSet::class, $set);
        $this->assertSame($name, $set->name);
        $this->assertNotEmpty($set->stickers);
        $this->assertInstanceOf(Sticker::class, $set->stickers[0]);

        return $set;
    }

    #[Depends('testGetStickerSet')]
    public function testSetStickerSetTitle(StickerSet $set): StickerSet
    {
        $this->skipUnlessUserId();

        $result = self::$client->setStickerSetTitle(
            name: $set->name,
            title: 'Pechkin Integration Test (renamed)',
        );
        $this->assertTrue($result);

        return $set;
    }

    #[Depends('testSetStickerSetTitle')]
    public function testSetStickerSetThumbnail(StickerSet $set): StickerSet
    {
        $this->skipUnlessUserId();

        // Upload a fresh PNG to use as thumbnail
        $thumb = self::$client->uploadStickerFile(
            user_id: self::$userId,
            sticker: new InputFile('thumb.png', self::stickerPng()),
            sticker_format: 'static',
        );

        $result = self::$client->setStickerSetThumbnail(
            name: $set->name,
            user_id: self::$userId,
            format: 'static',
            thumbnail: new InputFile('thumb.png', self::stickerPng()),
        );
        $this->assertTrue($result);

        return $set;
    }

    #[Depends('testSetStickerSetThumbnail')]
    public function testSetStickerEmojiList(StickerSet $set): StickerSet
    {
        $this->skipUnlessUserId();

        $stickerId = $set->stickers[0]->file_id;

        $result = self::$client->setStickerEmojiList(
            sticker: $stickerId,
            emoji_list: ['🎉'],
        );
        $this->assertTrue($result);

        return $set;
    }

    #[Depends('testSetStickerEmojiList')]
    public function testSetStickerKeywords(StickerSet $set): StickerSet
    {
        $this->skipUnlessUserId();

        $result = self::$client->setStickerKeywords(
            sticker: $set->stickers[0]->file_id,
            keywords: ['integration', 'test'],
        );
        $this->assertTrue($result);

        return $set;
    }

    #[Depends('testSetStickerKeywords')]
    public function testAddStickerToSet(StickerSet $set): StickerSet
    {
        $this->skipUnlessUserId();

        // Upload a second sticker file to add to the set
        $file2 = self::$client->uploadStickerFile(
            user_id: self::$userId,
            sticker: new InputFile('sticker2.png', self::stickerPng()),
            sticker_format: 'static',
        );

        $result = self::$client->addStickerToSet(
            user_id: self::$userId,
            name: $set->name,
            sticker: InputSticker::fromArray([
                'sticker' => $file2->file_id,
                'format' => 'static',
                'emoji_list' => ['🎊'],
            ]),
        );
        $this->assertTrue($result);

        // Fetch the updated set so dependents see two stickers
        $updated = self::$client->getStickerSet($set->name);
        $this->assertCount(2, $updated->stickers);

        return $updated;
    }

    #[Depends('testAddStickerToSet')]
    public function testSetStickerPositionInSet(StickerSet $set): StickerSet
    {
        $this->skipUnlessUserId();

        // Move sticker[1] to position 0
        $result = self::$client->setStickerPositionInSet(
            sticker: $set->stickers[1]->file_id,
            position: 0,
        );
        $this->assertTrue($result);

        return $set;
    }

    #[Depends('testSetStickerPositionInSet')]
    public function testDeleteStickerFromSet(StickerSet $set): StickerSet
    {
        $this->skipUnlessUserId();

        // Delete the second sticker (index 1); keep index 0 for teardown
        $result = self::$client->deleteStickerFromSet(
            sticker: $set->stickers[1]->file_id,
        );
        $this->assertTrue($result);

        return $set;
    }

    #[Depends('testDeleteStickerFromSet')]
    public function testDeleteStickerSet(StickerSet $set): void
    {
        $this->skipUnlessUserId();

        $result = self::$client->deleteStickerSet($set->name);
        $this->assertTrue($result);

        // Confirm it's gone
        $this->assertApiError(fn() =>
            self::$client->getStickerSet($set->name)
        );
    }

    // -------------------------------------------------------------------------
    // Methods that need a custom-emoji sticker type — not creatable via API;
    // assert 4xx to verify serialization path only.
    // -------------------------------------------------------------------------

    /**
     * setCustomEmojiStickerSetThumbnail requires a set of type custom_emoji,
     * which can only be created through @Stickers bot, not via the API.
     */
    public function testSetCustomEmojiStickerSetThumbnail(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setCustomEmojiStickerSetThumbnail('fake_set_integration_test')
        );
    }

    /**
     * getCustomEmojiStickers requires valid custom emoji IDs from a custom_emoji
     * sticker set. Custom emoji IDs are not obtainable without an existing set.
     */
    public function testGetCustomEmojiStickers(): void
    {
        $this->assertApiError(fn() =>
            self::$client->getCustomEmojiStickers(['fake_emoji_id_000'])
        );
    }

    /**
     * setStickerMaskPosition requires a sticker of type mask, which needs a
     * mask sticker set (sticker_type=mask). Keep as 4xx assertion.
     */
    public function testSetStickerMaskPosition(): void
    {
        $this->assertApiError(fn() =>
            self::$client->setStickerMaskPosition('fake_sticker_file_id')
        );
    }
}
