<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\RichTextEmailAddress;
use F4\Pechkin\DataType\RichText;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class RichTextEmailAddressTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('rich_text_email_address_full.json');
        $obj = RichTextEmailAddress::fromArray($data);

        $this->assertInstanceOf(RichTextEmailAddress::class, $obj);
        $this->assertSame('email_address', $obj->type);
        $this->assertInstanceOf(RichText::class, $obj->text);
        $this->assertSame('user@example.com', $obj->email_address);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('rich_text_email_address_full.json');
        $obj = RichTextEmailAddress::fromArray($data);
        $this->assertEquals([...$data, 'type' => 'email_address'], $obj->toArray());
    }
}
