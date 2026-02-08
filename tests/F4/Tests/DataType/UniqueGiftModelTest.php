<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Sticker;
use F4\Pechkin\DataType\UniqueGiftModel;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class UniqueGiftModelTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('unique_gift_model_full.json');
        $uniqueGiftModel = UniqueGiftModel::fromArray($data);

        $this->assertInstanceOf(UniqueGiftModel::class, $uniqueGiftModel);
        $this->assertInstanceOf(Sticker::class, $uniqueGiftModel->sticker);
        $this->assertSame('Test Name', $uniqueGiftModel->name);
        $this->assertSame(42, $uniqueGiftModel->rarity_per_mille);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('unique_gift_model_minimal.json');
        $uniqueGiftModel = UniqueGiftModel::fromArray($data);
        $this->assertEquals($data, $uniqueGiftModel->toArray());
    }
}
