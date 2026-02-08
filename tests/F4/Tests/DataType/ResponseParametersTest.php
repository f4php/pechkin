<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ResponseParameters;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ResponseParametersTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('response_parameters_full.json');
        $responseParameters = ResponseParameters::fromArray($data);

        $this->assertInstanceOf(ResponseParameters::class, $responseParameters);
        $this->assertSame('-1001234567891', $responseParameters->migrate_to_chat_id);
        $this->assertSame(42, $responseParameters->retry_after);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('response_parameters_minimal.json');
        $responseParameters = ResponseParameters::fromArray($data);

        $this->assertInstanceOf(ResponseParameters::class, $responseParameters);
        $this->assertNull($responseParameters->migrate_to_chat_id);
        $this->assertNull($responseParameters->retry_after);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('response_parameters_minimal.json');
        $responseParameters = ResponseParameters::fromArray($data);
        $this->assertEquals($data, $responseParameters->toArray());
    }
}
