<?php

declare(strict_types=1);

namespace F4\Pechkin\DataType;

use F4\Pechkin\DataType\{
    AbstractDataType,
    RichTextAnchor,
    RichTextAnchorLink,
    RichTextBankCardNumber,
    RichTextBold,
    RichTextBotCommand,
    RichTextButton,
    RichTextCashtag,
    RichTextCode,
    RichTextCustomEmoji,
    RichTextDateTime,
    RichTextEmailAddress,
    RichTextHashtag,
    RichTextItalic,
    RichTextMarked,
    RichTextMathematicalExpression,
    RichTextMention,
    RichTextPhoneNumber,
    RichTextReference,
    RichTextReferenceLink,
    RichTextSpoiler,
    RichTextStrikethrough,
    RichTextSubscript,
    RichTextSuperscript,
    RichTextTextMention,
    RichTextUnderline,
    RichTextUrl,
    Attribute\Polymorphic,
};

#[Polymorphic([
    'bold' => RichTextBold::class,
    'italic' => RichTextItalic::class,
    'underline' => RichTextUnderline::class,
    'strikethrough' => RichTextStrikethrough::class,
    'spoiler' => RichTextSpoiler::class,
    'date_time' => RichTextDateTime::class,
    'text_mention' => RichTextTextMention::class,
    'subscript' => RichTextSubscript::class,
    'superscript' => RichTextSuperscript::class,
    'marked' => RichTextMarked::class,
    'code' => RichTextCode::class,
    'custom_emoji' => RichTextCustomEmoji::class,
    'mathematical_expression' => RichTextMathematicalExpression::class,
    'url' => RichTextUrl::class,
    'email_address' => RichTextEmailAddress::class,
    'phone_number' => RichTextPhoneNumber::class,
    'bank_card_number' => RichTextBankCardNumber::class,
    'mention' => RichTextMention::class,
    'hashtag' => RichTextHashtag::class,
    'cashtag' => RichTextCashtag::class,
    'bot_command' => RichTextBotCommand::class,
    'button' => RichTextButton::class,
    'anchor' => RichTextAnchor::class,
    'anchor_link' => RichTextAnchorLink::class,
    'reference' => RichTextReference::class,
    'reference_link' => RichTextReferenceLink::class,
])]
abstract readonly class RichText extends AbstractDataType
{
    public readonly string $type;
}
