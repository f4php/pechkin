<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use InvalidArgumentException;
use F4\Pechkin\DataType\{
    AbstractDataType,
    Animation,
    Audio,
    Document,
    Link,
    LivePhoto,
    Location,
    PhotoSize,
    Sticker,
    Venue,
    Video,
    Attribute\ArrayOf,
};
use function 
    array_filter,
    count
;

readonly class PollMedia extends AbstractDataType
{
    public function __construct(
        public readonly ?Animation $animation = null,
        public readonly ?Audio $audio = null,
        public readonly ?Document $document = null,
        public readonly ?Link $link = null,
        public readonly ?LivePhoto $live_photo = null,
        public readonly ?Location $location = null,
        /** @var PhotoSize[]|null */
        #[ArrayOf(PhotoSize::class)]
        public readonly ?array $photo = null,
        public readonly ?Sticker $sticker = null,
        public readonly ?Venue $venue = null,
        public readonly ?Video $video = null,
    ) {
        if (1 < count(array_filter([
            $this->animation,
            $this->audio,
            $this->document,
            $this->live_photo,
            $this->location,
            $this->photo,
            $this->sticker,
            $this->venue,
            $this->video,
            $this->link,
        ]))) {
            throw new InvalidArgumentException('At most one media field may be set.');
        }

    }
}
