<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\AbstractDataType;
use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\Message;
use PHPUnit\Framework\TestCase;

/**
 * Covers graceful degradation when the upstream Telegram API introduces
 * additions the library does not yet know about:
 *   - new properties on an existing object are dropped + warned;
 *   - an unknown polymorphic subtype resolves to null + warned.
 */
final class ForwardCompatibilityTest extends TestCase
{
    /** @var list<string> */
    private array $warnings = [];

    protected function setUp(): void
    {
        $this->warnings = [];
        AbstractDataType::setWarningHandler(function (string $message): void {
            $this->warnings[] = $message;
        });
    }

    protected function tearDown(): void
    {
        AbstractDataType::setWarningHandler(null);
    }

    public function testUnknownPropertyIsIgnored(): void
    {
        $chat = Chat::fromArray([
            'id' => '123456789',
            'type' => 'private',
            'first_name' => 'John',
            'future_field' => 'value from a newer API version',
        ]);

        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertSame('123456789', $chat->id);
        $this->assertSame('private', $chat->type);
        $this->assertSame('John', $chat->first_name);
        // the unknown key must not survive into the array representation
        $this->assertArrayNotHasKey('future_field', $chat->toArray());
    }

    public function testUnknownPropertyTriggersWarning(): void
    {
        Chat::fromArray([
            'id' => '123456789',
            'type' => 'private',
            'future_field' => 'x',
        ]);

        $this->assertCount(1, $this->warnings);
        $this->assertStringContainsString('future_field', $this->warnings[0]);
        $this->assertStringContainsString(Chat::class, $this->warnings[0]);
    }

    public function testKnownDataEmitsNoWarning(): void
    {
        Chat::fromArray([
            'id' => '123456789',
            'type' => 'private',
            'first_name' => 'John',
        ]);

        $this->assertSame([], $this->warnings);
    }

    public function testUnknownPolymorphicSubtypeResolvesToNull(): void
    {
        $message = Message::fromArray([
            'message_id' => 1,
            'date' => 1700000000,
            'chat' => [
                'id' => '123456789',
                'type' => 'private',
            ],
            'forward_origin' => [
                'type' => 'brand_new_origin_from_a_newer_api',
                'date' => 1700000000,
            ],
        ]);

        $this->assertInstanceOf(Message::class, $message);
        // the surrounding object still deserializes; only the unknown subtype is lost
        $this->assertNull($message->forward_origin);

        $this->assertNotEmpty($this->warnings);
        $this->assertStringContainsString('brand_new_origin_from_a_newer_api', $this->warnings[0]);
    }
}
