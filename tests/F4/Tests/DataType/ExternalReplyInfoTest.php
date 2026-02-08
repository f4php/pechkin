<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Animation;
use F4\Pechkin\DataType\Audio;
use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\Checklist;
use F4\Pechkin\DataType\Contact;
use F4\Pechkin\DataType\Dice;
use F4\Pechkin\DataType\Document;
use F4\Pechkin\DataType\ExternalReplyInfo;
use F4\Pechkin\DataType\Game;
use F4\Pechkin\DataType\Giveaway;
use F4\Pechkin\DataType\GiveawayWinners;
use F4\Pechkin\DataType\Invoice;
use F4\Pechkin\DataType\LinkPreviewOptions;
use F4\Pechkin\DataType\Location;
use F4\Pechkin\DataType\MessageOrigin;
use F4\Pechkin\DataType\PaidMediaInfo;
use F4\Pechkin\DataType\Poll;
use F4\Pechkin\DataType\Sticker;
use F4\Pechkin\DataType\Story;
use F4\Pechkin\DataType\Venue;
use F4\Pechkin\DataType\Video;
use F4\Pechkin\DataType\VideoNote;
use F4\Pechkin\DataType\Voice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ExternalReplyInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('external_reply_info_full.json');
        $externalReplyInfo = ExternalReplyInfo::fromArray($data);

        $this->assertInstanceOf(ExternalReplyInfo::class, $externalReplyInfo);
        $this->assertNotNull($externalReplyInfo->origin);
        $this->assertInstanceOf(Chat::class, $externalReplyInfo->chat);
        $this->assertInstanceOf(LinkPreviewOptions::class, $externalReplyInfo->link_preview_options);
        $this->assertInstanceOf(Animation::class, $externalReplyInfo->animation);
        $this->assertInstanceOf(Audio::class, $externalReplyInfo->audio);
        $this->assertInstanceOf(MessageOrigin::class, $externalReplyInfo->origin);
        $this->assertSame(42, $externalReplyInfo->message_id);
        $this->assertInstanceOf(Document::class, $externalReplyInfo->document);
        $this->assertInstanceOf(PaidMediaInfo::class, $externalReplyInfo->paid_media);
        $this->assertNotEmpty($externalReplyInfo->photo);
        $this->assertInstanceOf(Sticker::class, $externalReplyInfo->sticker);
        $this->assertInstanceOf(Story::class, $externalReplyInfo->story);
        $this->assertInstanceOf(Video::class, $externalReplyInfo->video);
        $this->assertInstanceOf(VideoNote::class, $externalReplyInfo->video_note);
        $this->assertInstanceOf(Voice::class, $externalReplyInfo->voice);
        $this->assertSame(true, $externalReplyInfo->has_media_spoiler);
        $this->assertInstanceOf(Checklist::class, $externalReplyInfo->checklist);
        $this->assertInstanceOf(Contact::class, $externalReplyInfo->contact);
        $this->assertInstanceOf(Dice::class, $externalReplyInfo->dice);
        $this->assertInstanceOf(Game::class, $externalReplyInfo->game);
        $this->assertInstanceOf(Giveaway::class, $externalReplyInfo->giveaway);
        $this->assertInstanceOf(GiveawayWinners::class, $externalReplyInfo->giveaway_winners);
        $this->assertInstanceOf(Invoice::class, $externalReplyInfo->invoice);
        $this->assertInstanceOf(Location::class, $externalReplyInfo->location);
        $this->assertInstanceOf(Poll::class, $externalReplyInfo->poll);
        $this->assertInstanceOf(Venue::class, $externalReplyInfo->venue);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('external_reply_info_minimal.json');
        $externalReplyInfo = ExternalReplyInfo::fromArray($data);

        $this->assertInstanceOf(ExternalReplyInfo::class, $externalReplyInfo);
        $this->assertNull($externalReplyInfo->chat);
        $this->assertNull($externalReplyInfo->message_id);
        $this->assertNull($externalReplyInfo->link_preview_options);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('external_reply_info_minimal.json');
        $externalReplyInfo = ExternalReplyInfo::fromArray($data);
        $this->assertEquals($data, $externalReplyInfo->toArray());
    }
}
