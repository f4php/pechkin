<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\EphemeralMessageParameters;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class EphemeralMessageParametersTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('ephemeral_message_parameters_full.json');
        $obj = EphemeralMessageParameters::fromArray($data);

        $this->assertInstanceOf(EphemeralMessageParameters::class, $obj);
        $this->assertSame('123456789', $obj->receiver_user_id);
        $this->assertSame('callback_123', $obj->callback_query_id);
        $this->assertTrue($obj->replace_callback_query_message);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('ephemeral_message_parameters_minimal.json');
        $obj = EphemeralMessageParameters::fromArray($data);

        $this->assertInstanceOf(EphemeralMessageParameters::class, $obj);
        $this->assertSame('123456789', $obj->receiver_user_id);
        $this->assertNull($obj->callback_query_id);
        $this->assertNull($obj->replace_callback_query_message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('ephemeral_message_parameters_minimal.json');
        $obj = EphemeralMessageParameters::fromArray($data);
        $this->assertEquals($data, $obj->toArray());
    }
}
