<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\EncryptedCredentials;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class EncryptedCredentialsTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('encrypted_credentials_full.json');
        $encryptedCredentials = EncryptedCredentials::fromArray($data);

        $this->assertInstanceOf(EncryptedCredentials::class, $encryptedCredentials);
        $this->assertSame('callback_data_123', $encryptedCredentials->data);
        $this->assertSame('hash_value_xyz', $encryptedCredentials->hash);
        $this->assertSame('secret_hash_abc', $encryptedCredentials->secret);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('encrypted_credentials_minimal.json');
        $encryptedCredentials = EncryptedCredentials::fromArray($data);
        $this->assertEquals($data, $encryptedCredentials->toArray());
    }
}
