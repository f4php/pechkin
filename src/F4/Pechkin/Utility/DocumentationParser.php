<?php

declare(strict_types=1);

namespace F4\Pechkin\Utility;

// Documentation source: https://core.telegram.org/bots/api

use RuntimeException,
    Dom\HTMLDocument,
    F4\Pechkin\Utility\DocumentationSection,
    F4\Pechkin\Utility\HtmlToMarkdownConverter,
    F4\Pechkin\Utility\SectionKind
;
use function
    array_filter,
    ctype_upper,
    implode,
    in_array,
    sprintf,
    str_contains,
    strtolower,
    trim
;
use const LIBXML_NOERROR;

class DocumentationParser
{
    public const string BASE_URL = 'https://core.telegram.org/bots/api';

    /**
     * @return list<DocumentationSection>
     */
    public function parse(string $html): array
    {
        $document = HTMLDocument::createFromString($html, LIBXML_NOERROR);
        $content = $document->querySelector('#dev_page_content') ?? throw new RuntimeException('Could not find #dev_page_content, page layout may have changed');
        $converter = new HtmlToMarkdownConverter(self::BASE_URL);
        $sections = [];
        $name = null;
        $kind = null;
        $blocks = [];
        foreach ($content->children as $element) {
            $tag = strtolower($element->localName);
            if (in_array($tag, ['h3', 'h4'], true)) {
                if ($name !== null && $kind !== null) {
                    $sections[] = $this->buildSection($name, $kind, $blocks);
                }
                $name = null;
                $kind = null;
                $blocks = [];
                if ($tag === 'h4') {
                    $title = trim($element->textContent ?? '');
                    $kind = match (true) {
                        $title === '', str_contains($title, ' ') => null,
                        ctype_upper($title[0]) => SectionKind::DataType,
                        default => SectionKind::Method,
                    };
                    $name = $kind !== null ? $title : null;
                }
            }
            elseif ($name !== null) {
                $blocks[] = $converter->convertBlock($element);
            }
        }
        if ($name !== null && $kind !== null) {
            $sections[] = $this->buildSection($name, $kind, $blocks);
        }
        return $sections;
    }

    /**
     * @param list<string> $blocks
     */
    protected function buildSection(string $name, SectionKind $kind, array $blocks): DocumentationSection
    {
        return new DocumentationSection(
            name: $name,
            kind: $kind,
            markdown: sprintf(
                "# %s\n\nSource: %s#%s\n\n%s\n",
                $name,
                self::BASE_URL,
                strtolower($name),
                implode("\n\n", array_filter($blocks, fn(string $block): bool => $block !== '')),
            ),
        );
    }
}
