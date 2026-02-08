<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\PaidMediaPreview;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class PaidMediaPreviewTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('paid_media_preview_full.json');
        $paidMediaPreview = PaidMediaPreview::fromArray($data);

        $this->assertInstanceOf(PaidMediaPreview::class, $paidMediaPreview);
        $this->assertSame(640, $paidMediaPreview->width);
        $this->assertSame(480, $paidMediaPreview->height);
        $this->assertSame(120, $paidMediaPreview->duration);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('paid_media_preview_minimal.json');
        $paidMediaPreview = PaidMediaPreview::fromArray($data);

        $this->assertInstanceOf(PaidMediaPreview::class, $paidMediaPreview);
        $this->assertNull($paidMediaPreview->width);
        $this->assertNull($paidMediaPreview->height);
        $this->assertNull($paidMediaPreview->duration);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('paid_media_preview_minimal.json');
        $paidMediaPreview = PaidMediaPreview::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'preview'], $paidMediaPreview->toArray());
    }
}
