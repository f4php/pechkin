<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputChecklistTask;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputChecklistTaskTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_checklist_task_full.json');
        $inputChecklistTask = InputChecklistTask::fromArray($data);

        $this->assertInstanceOf(InputChecklistTask::class, $inputChecklistTask);
        $this->assertNotEmpty($inputChecklistTask->text_entities);
        $this->assertSame(123456789, $inputChecklistTask->id);
        $this->assertSame('Hello, World!', $inputChecklistTask->text);
        $this->assertSame('HTML', $inputChecklistTask->parse_mode);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_checklist_task_minimal.json');
        $inputChecklistTask = InputChecklistTask::fromArray($data);

        $this->assertInstanceOf(InputChecklistTask::class, $inputChecklistTask);
        $this->assertNull($inputChecklistTask->parse_mode);
        $this->assertNull($inputChecklistTask->text_entities);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_checklist_task_minimal.json');
        $inputChecklistTask = InputChecklistTask::fromArray($data);
        $this->assertEquals($data, $inputChecklistTask->toArray());
    }
}
