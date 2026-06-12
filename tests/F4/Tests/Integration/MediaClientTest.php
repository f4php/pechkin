<?php

declare(strict_types=1);

namespace F4\Tests\Integration;

use F4\Pechkin\DataType\{
    InputFile,
    InputMediaPhoto,
    InputMediaVideo,
    InputPaidMediaPhoto,
    Message,
};
use PHPUnit\Framework\Attributes\{
    Depends,
    Group,
};

/**
 * Real send tests for every media type, using tiny ffmpeg-generated files
 * from the Fixtures directory.
 */
#[Group('integration')]
#[Group('integration:basic')]
final class MediaClientTest extends IntegrationTestCase
{
    public function testSendAudio(): void
    {
        $msg = self::$client->sendAudio(
            chat_id: self::$chatId,
            audio: new InputFile('audio.mp3', self::fixture('audio.mp3')),
            caption: '[integration] testSendAudio',
            performer: 'Pechkin',
            title: 'Integration Test Tone',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->audio);
    }

    public function testSendVoice(): void
    {
        $msg = self::$client->sendVoice(
            chat_id: self::$chatId,
            voice: new InputFile('voice.ogg', self::fixture('voice.ogg')),
            caption: '[integration] testSendVoice',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->voice);
    }

    public function testSendVideo(): Message
    {
        $msg = self::$client->sendVideo(
            chat_id: self::$chatId,
            video: new InputFile('video.mp4', self::fixture('video.mp4')),
            caption: '[integration] testSendVideo',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->video);

        return $msg;
    }

    #[Depends('testSendVideo')]
    public function testEditMessageMedia(Message $msg): void
    {
        // replace the video with itself (by file_id) under a new caption
        $result = self::$client->editMessageMedia(
            media: new InputMediaVideo(
                media: $msg->video->file_id,
                caption: '[integration] testEditMessageMedia',
            ),
            chat_id: self::$chatId,
            message_id: $msg->message_id,
        );

        $this->assertInstanceOf(Message::class, $result);
        $this->assertSame('[integration] testEditMessageMedia', $result->caption);
    }

    public function testSendVideoNote(): void
    {
        $msg = self::$client->sendVideoNote(
            chat_id: self::$chatId,
            video_note: new InputFile('video_note.mp4', self::fixture('video_note.mp4')),
            length: 240,
            duration: 1,
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->video_note);
    }

    public function testSendAnimation(): void
    {
        $msg = self::$client->sendAnimation(
            chat_id: self::$chatId,
            animation: new InputFile('animation.mp4', self::fixture('animation.mp4')),
            caption: '[integration] testSendAnimation',
        );

        $this->assertInstanceOf(Message::class, $msg);
        // Telegram may classify a soundless mp4 as either animation or video
        $this->assertTrue($msg->animation !== null || $msg->video !== null || $msg->document !== null);
    }

    public function testSendMediaGroup(): void
    {
        // upload once to obtain a reusable file_id
        $photo = self::$client->sendPhoto(
            chat_id: self::$chatId,
            photo: new InputFile('photo.png', self::fixture('photo_512.png')),
            caption: '[integration] testSendMediaGroup source',
        );
        $fileId = $photo->photo[0]->file_id;

        $messages = self::$client->sendMediaGroup(
            chat_id: self::$chatId,
            media: [
                new InputMediaPhoto(media: $fileId, caption: '[integration] testSendMediaGroup 1 of 2'),
                new InputMediaPhoto(media: $fileId, caption: '[integration] testSendMediaGroup 2 of 2'),
            ],
        );

        $this->assertIsArray($messages);
        $this->assertCount(2, $messages);
        $this->assertContainsOnlyInstancesOf(Message::class, $messages);
    }

    public function testSendSticker(): void
    {
        if (!extension_loaded('gd')) {
            $this->markTestSkipped('Requires the gd extension to generate a WEBP sticker');
        }
        $image = imagecreatetruecolor(512, 512);
        imagefilledrectangle($image, 0, 0, 511, 511, imagecolorallocate($image, 128, 0, 128));
        ob_start();
        imagewebp($image);
        $webp = ob_get_clean();

        $msg = self::$client->sendSticker(
            chat_id: self::$chatId,
            sticker: new InputFile('sticker.webp', $webp),
            emoji: '🤖',
        );

        $this->assertInstanceOf(Message::class, $msg);
        $this->assertNotNull($msg->sticker);
    }

    public function testSendLivePhoto(): void
    {
        // live photos require specially-prepared content; skip if Telegram rejects ours
        $msg = $this->attemptOrSkip(fn() => self::$client->sendLivePhoto(
            chat_id: self::$chatId,
            photo: new InputFile('photo.png', self::fixture('photo_512.png')),
            live_photo: new InputFile('live.mp4', self::fixture('video.mp4')),
            caption: '[integration] testSendLivePhoto',
        ), 'sendLivePhoto');

        $this->assertInstanceOf(Message::class, $msg);
    }

    public function testSendPaidMedia(): void
    {
        // paid media can only be sent to channels the bot administers; see ChannelClientTest
        $this->assertApiError(fn() =>
            self::$client->sendPaidMedia(
                chat_id: self::$chatId,
                star_count: 1,
                media: [new InputPaidMediaPhoto(media: 'fake_file_id')],
            )
        );
    }
}
