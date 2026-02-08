<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChecklistTasksDone;
use F4\Pechkin\DataType\Message;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChecklistTasksDoneTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('checklist_tasks_done_full.json');
        $checklistTasksDone = ChecklistTasksDone::fromArray($data);

        $this->assertInstanceOf(ChecklistTasksDone::class, $checklistTasksDone);
        $this->assertInstanceOf(Message::class, $checklistTasksDone->checklist_message);
        $this->assertNotEmpty($checklistTasksDone->marked_as_done_task_ids);
        $this->assertNotEmpty($checklistTasksDone->marked_as_not_done_task_ids);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('checklist_tasks_done_minimal.json');
        $checklistTasksDone = ChecklistTasksDone::fromArray($data);

        $this->assertInstanceOf(ChecklistTasksDone::class, $checklistTasksDone);
        $this->assertNull($checklistTasksDone->checklist_message);
        $this->assertNull($checklistTasksDone->marked_as_done_task_ids);
        $this->assertNull($checklistTasksDone->marked_as_not_done_task_ids);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('checklist_tasks_done_minimal.json');
        $checklistTasksDone = ChecklistTasksDone::fromArray($data);
        $this->assertEquals($data, $checklistTasksDone->toArray());
    }
}
