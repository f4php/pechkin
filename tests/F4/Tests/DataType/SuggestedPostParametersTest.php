<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\SuggestedPostParameters;
use F4\Pechkin\DataType\SuggestedPostPrice;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class SuggestedPostParametersTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('suggested_post_parameters_full.json');
        $suggestedPostParameters = SuggestedPostParameters::fromArray($data);

        $this->assertInstanceOf(SuggestedPostParameters::class, $suggestedPostParameters);
        $this->assertInstanceOf(SuggestedPostPrice::class, $suggestedPostParameters->price);
        $this->assertSame(1700000000, $suggestedPostParameters->send_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('suggested_post_parameters_minimal.json');
        $suggestedPostParameters = SuggestedPostParameters::fromArray($data);

        $this->assertInstanceOf(SuggestedPostParameters::class, $suggestedPostParameters);
        $this->assertNull($suggestedPostParameters->price);
        $this->assertNull($suggestedPostParameters->send_date);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('suggested_post_parameters_minimal.json');
        $suggestedPostParameters = SuggestedPostParameters::fromArray($data);
        $this->assertEquals($data, $suggestedPostParameters->toArray());
    }
}
