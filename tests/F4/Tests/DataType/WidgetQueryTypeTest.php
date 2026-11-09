<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\WidgetQueryType;
use F4\Pechkin\DataType\WidgetQueryTypeData;
use F4\Pechkin\DataType\WidgetQueryTypeSentTransaction;
use F4\Pechkin\DataType\WidgetQueryTypeSignData;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class WidgetQueryTypeTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayWithDataType(): void
    {
        $data = [
            ...$this->loadFixture('widget_query_type_data_full.json'),
            'type' => 'data',
        ];
        $result = WidgetQueryType::fromArray($data);
        $this->assertInstanceOf(WidgetQueryTypeData::class, $result);
    }

    public function testFromArrayWithSignDataType(): void
    {
        $data = [
            ...$this->loadFixture('widget_query_type_sign_data_full.json'),
            'type' => 'sign_data',
        ];
        $result = WidgetQueryType::fromArray($data);
        $this->assertInstanceOf(WidgetQueryTypeSignData::class, $result);
    }

    public function testFromArrayWithSentTransactionType(): void
    {
        $data = [
            ...$this->loadFixture('widget_query_type_sent_transaction_full.json'),
            'type' => 'sent_transaction',
        ];
        $result = WidgetQueryType::fromArray($data);
        $this->assertInstanceOf(WidgetQueryTypeSentTransaction::class, $result);
    }
}
