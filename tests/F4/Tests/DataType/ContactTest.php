<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Contact;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('contact_full.json');
        $contact = Contact::fromArray($data);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertSame('+1234567890', $contact->phone_number);
        $this->assertSame('John', $contact->first_name);
        $this->assertSame('Doe', $contact->last_name);
        $this->assertSame('987654321', $contact->user_id);
        $this->assertSame('BEGIN:VCARD\\nVERSION:3.0\\nFN:John Doe\\nEND:VCARD', $contact->vcard);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('contact_minimal.json');
        $contact = Contact::fromArray($data);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertNull($contact->last_name);
        $this->assertNull($contact->user_id);
        $this->assertNull($contact->vcard);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('contact_minimal.json');
        $contact = Contact::fromArray($data);
        $this->assertEquals($data, $contact->toArray());
    }
}
