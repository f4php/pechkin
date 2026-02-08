<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\LinkPreviewOptions;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class LinkPreviewOptionsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('link_preview_options_full.json');
        $linkPreviewOptions = LinkPreviewOptions::fromArray($data);

        $this->assertInstanceOf(LinkPreviewOptions::class, $linkPreviewOptions);
        $this->assertSame(false, $linkPreviewOptions->is_disabled);
        $this->assertSame('https://example.com', $linkPreviewOptions->url);
        $this->assertSame(false, $linkPreviewOptions->prefer_small_media);
        $this->assertSame(false, $linkPreviewOptions->prefer_large_media);
        $this->assertSame(false, $linkPreviewOptions->show_above_text);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('link_preview_options_minimal.json');
        $linkPreviewOptions = LinkPreviewOptions::fromArray($data);

        $this->assertInstanceOf(LinkPreviewOptions::class, $linkPreviewOptions);
        $this->assertNull($linkPreviewOptions->is_disabled);
        $this->assertNull($linkPreviewOptions->url);
        $this->assertNull($linkPreviewOptions->prefer_small_media);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('link_preview_options_minimal.json');
        $linkPreviewOptions = LinkPreviewOptions::fromArray($data);
        $this->assertEquals($data, $linkPreviewOptions->toArray());
    }
}
