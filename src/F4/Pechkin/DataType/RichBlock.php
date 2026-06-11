<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    RichBlockAnchor,
    RichBlockAnimation,
    RichBlockAudio,
    RichBlockBlockQuotation,
    RichBlockCollage,
    RichBlockDetails,
    RichBlockDivider,
    RichBlockFooter,
    RichBlockList,
    RichBlockMap,
    RichBlockMathematicalExpression,
    RichBlockPhoto,
    RichBlockPreformatted,
    RichBlockPullQuotation,
    RichBlockSectionHeading,
    RichBlockSlideshow,
    RichBlockTable,
    RichBlockThinking,
    RichBlockParagraph,
    RichBlockVideo,
    RichBlockVoiceNote,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'paragraph' => RichBlockParagraph::class,
    'section_heading' => RichBlockSectionHeading::class,
    'preformatted' => RichBlockPreformatted::class,
    'footer' => RichBlockFooter::class,
    'divider' => RichBlockDivider::class,
    'mathematical_expression' => RichBlockMathematicalExpression::class,
    'anchor' => RichBlockAnchor::class,
    'list' => RichBlockList::class,
    'block_quotation' => RichBlockBlockQuotation::class,
    'pull_quotation' => RichBlockPullQuotation::class,
    'collage' => RichBlockCollage::class,
    'slideshow' => RichBlockSlideshow::class,
    'table' => RichBlockTable::class,
    'details' => RichBlockDetails::class,
    'map' => RichBlockMap::class,
    'animation' => RichBlockAnimation::class,
    'audio' => RichBlockAudio::class,
    'photo' => RichBlockPhoto::class,
    'video' => RichBlockVideo::class,
    'voice_note' => RichBlockVoiceNote::class,
    'thinking' => RichBlockThinking::class,
])]
abstract readonly class RichBlock extends AbstractDataType
{
    public readonly string $type;
}
