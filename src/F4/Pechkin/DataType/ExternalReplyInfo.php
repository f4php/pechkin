<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    Animation,
    Audio,
    Chat,
    Checklist,
    Contact,
    Dice,
    Document,
    Game,
    Giveaway,
    GiveawayWinners,
    Invoice,
    LinkPreviewOptions,
    Location,
    MessageOrigin,
    PaidMediaInfo,
    PhotoSize,
    Poll,
    Sticker,
    Story,
    Venue,
    Video,
    VideoNote,
    Voice,
};

readonly class ExternalReplyInfo extends AbstractDataType
{
    public function __construct(
        public readonly MessageOrigin $origin,
        public readonly ?Chat $chat = null,
        public readonly ?int $message_id = null,
        public readonly ?LinkPreviewOptions $link_preview_options = null,
        public readonly ?Animation $animation = null,
        public readonly ?Audio $audio = null,
        public readonly ?Document $document = null,
        public readonly ?PaidMediaInfo $paid_media = null,
        /** @var PhotoSize[]|null */
        public readonly ?array $photo = null,
        public readonly ?Sticker $sticker = null,
        public readonly ?Story $story = null,
        public readonly ?Video $video = null,
        public readonly ?VideoNote $video_note = null,
        public readonly ?Voice $voice = null,
        public readonly ?bool $has_media_spoiler = null,
        public readonly ?Checklist $checklist = null,
        public readonly ?Contact $contact = null,
        public readonly ?Dice $dice = null,
        public readonly ?Game $game = null,
        public readonly ?Giveaway $giveaway = null,
        public readonly ?GiveawayWinners $giveaway_winners = null,
        public readonly ?Invoice $invoice = null,
        public readonly ?Location $location = null,
        public readonly ?Poll $poll = null,
        public readonly ?Venue $venue = null,
    ) {}
}
