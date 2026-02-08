<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\WebhookInfo;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WebhookInfoTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('webhook_info_full.json');
        $webhookInfo = WebhookInfo::fromArray($data);

        $this->assertInstanceOf(WebhookInfo::class, $webhookInfo);
        $this->assertNotEmpty($webhookInfo->allowed_updates);
        $this->assertSame('https://example.com', $webhookInfo->url);
        $this->assertSame(false, $webhookInfo->has_custom_certificate);
        $this->assertSame(0, $webhookInfo->pending_update_count);
        $this->assertSame('1.2.3.4', $webhookInfo->ip_address);
        $this->assertSame(1700000000, $webhookInfo->last_error_date);
        $this->assertSame('Connection timed out', $webhookInfo->last_error_message);
        $this->assertSame(1700000000, $webhookInfo->last_synchronization_error_date);
        $this->assertSame(40, $webhookInfo->max_connections);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('webhook_info_minimal.json');
        $webhookInfo = WebhookInfo::fromArray($data);

        $this->assertInstanceOf(WebhookInfo::class, $webhookInfo);
        $this->assertNull($webhookInfo->ip_address);
        $this->assertNull($webhookInfo->last_error_date);
        $this->assertNull($webhookInfo->last_error_message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('webhook_info_minimal.json');
        $webhookInfo = WebhookInfo::fromArray($data);
        $this->assertEquals($data, $webhookInfo->toArray());
    }
}
