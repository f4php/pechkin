<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    InputRichBlockAnchor,
    InputRichBlockAnimation,
    InputRichBlockAudio,
    InputRichBlockBlockQuotation,
    InputRichBlockCollage,
    InputRichBlockDetails,
    InputRichBlockDivider,
    InputRichBlockFooter,
    InputRichBlockList,
    InputRichBlockMap,
    InputRichBlockMathematicalExpression,
    InputRichBlockPhoto,
    InputRichBlockPreformatted,
    InputRichBlockPullQuotation,
    InputRichBlockSectionHeading,
    InputRichBlockSlideshow,
    InputRichBlockTable,
    InputRichBlockThinking,
    InputRichBlockParagraph,
    InputRichBlockVideo,
    InputRichBlockVoiceNote,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'paragraph' => InputRichBlockParagraph::class,
    'heading' => InputRichBlockSectionHeading::class,
    'pre' => InputRichBlockPreformatted::class,
    'footer' => InputRichBlockFooter::class,
    'divider' => InputRichBlockDivider::class,
    'mathematical_expression' => InputRichBlockMathematicalExpression::class,
    'anchor' => InputRichBlockAnchor::class,
    'list' => InputRichBlockList::class,
    'blockquote' => InputRichBlockBlockQuotation::class,
    'pullquote' => InputRichBlockPullQuotation::class,
    'collage' => InputRichBlockCollage::class,
    'slideshow' => InputRichBlockSlideshow::class,
    'table' => InputRichBlockTable::class,
    'details' => InputRichBlockDetails::class,
    'map' => InputRichBlockMap::class,
    'animation' => InputRichBlockAnimation::class,
    'audio' => InputRichBlockAudio::class,
    'photo' => InputRichBlockPhoto::class,
    'video' => InputRichBlockVideo::class,
    'voice_note' => InputRichBlockVoiceNote::class,
    'thinking' => InputRichBlockThinking::class,
])]
abstract readonly class InputRichBlock extends AbstractDataType
{
    public readonly string $type;
}
