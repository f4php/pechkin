<?php

declare(strict_types=1);

namespace F4\Pechkin\Utility;

use Dom\Element,
    Dom\Node,
    Dom\Text
;
use function
    array_filter,
    array_map,
    count,
    explode,
    implode,
    sprintf,
    str_repeat,
    str_replace,
    str_starts_with,
    strtolower,
    trim
;

class HtmlToMarkdownConverter
{
    protected const string SITE_ROOT = 'https://core.telegram.org';

    public function __construct(protected readonly string $baseUrl) {}

    public function convertBlock(Element $element): string
    {
        return trim(match (strtolower($element->localName)) {
            'blockquote' => implode("\n", array_map(
                fn(string $line): string => trim('> ' . $line),
                explode("\n", trim($this->convertChildBlocks($element))),
            )),
            'ul' => $this->convertList($element, ordered: false),
            'ol' => $this->convertList($element, ordered: true),
            'table' => $this->convertTable($element),
            'pre' => "```\n" . trim($element->textContent ?? '') . "\n```",
            'h5' => '### ' . $this->convertInline($element),
            'h6' => '#### ' . $this->convertInline($element),
            default => $this->convertInline($element),
        });
    }

    protected function convertChildBlocks(Element $element): string
    {
        $blocks = [];
        foreach ($element->children as $child) {
            $blocks[] = $this->convertBlock($child);
        }
        return implode("\n\n", array_filter($blocks, fn(string $block): bool => $block !== ''));
    }

    protected function convertList(Element $list, bool $ordered): string
    {
        $items = [];
        $index = 0;
        foreach ($list->children as $item) {
            $items[] = ($ordered ? sprintf('%d. ', ++$index) : '- ') . trim($this->convertInline($item));
        }
        return implode("\n", $items);
    }

    protected function convertTable(Element $table): string
    {
        $rows = [];
        foreach ($table->querySelectorAll('tr') as $row) {
            $cells = [];
            foreach ($row->children as $cell) {
                $cells[] = str_replace(['|', "\n"], ['\\|', ' '], trim($this->convertInline($cell)));
            }
            $rows[] = '| ' . implode(' | ', $cells) . ' |';
            if (count($rows) === 1) {
                $rows[] = '|' . str_repeat(' --- |', count($cells));
            }
        }
        return implode("\n", $rows);
    }

    protected function convertInline(Node $node): string
    {
        $markdown = '';
        foreach ($node->childNodes as $child) {
            $markdown .= match (true) {
                $child instanceof Text => $child->textContent,
                $child instanceof Element => match (strtolower($child->localName)) {
                    'em', 'i' => '*' . $this->convertInline($child) . '*',
                    'strong', 'b' => '**' . $this->convertInline($child) . '**',
                    'code' => '`' . $child->textContent . '`',
                    'a' => $this->convertAnchor($child),
                    'img' => $child->getAttribute('alt') ?? '',
                    'br' => ' ',
                    default => $this->convertInline($child),
                },
                default => '',
            };
        }
        return $markdown;
    }

    protected function convertAnchor(Element $anchor): string
    {
        $text = trim($this->convertInline($anchor));
        $href = $anchor->getAttribute('href') ?? '';
        $url = match (true) {
            str_starts_with($href, '#') => $this->baseUrl . $href,
            str_starts_with($href, '//') => 'https:' . $href,
            str_starts_with($href, '/') => self::SITE_ROOT . $href,
            default => $href,
        };
        return match (true) {
            $text === '' => '',
            $url === '' => $text,
            default => sprintf('[%s](%s)', $text, $url),
        };
    }
}
