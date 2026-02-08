<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\ChecklistTasksAdded;
use F4\Pechkin\DataType\Message;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChecklistTasksAddedTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('checklist_tasks_added_full.json');
        $checklistTasksAdded = ChecklistTasksAdded::fromArray($data);

        $this->assertInstanceOf(ChecklistTasksAdded::class, $checklistTasksAdded);
        $this->assertNotEmpty($checklistTasksAdded->tasks);
        $this->assertInstanceOf(Message::class, $checklistTasksAdded->checklist_message);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('checklist_tasks_added_minimal.json');
        $checklistTasksAdded = ChecklistTasksAdded::fromArray($data);

        $this->assertInstanceOf(ChecklistTasksAdded::class, $checklistTasksAdded);
        $this->assertNull($checklistTasksAdded->checklist_message);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('checklist_tasks_added_minimal.json');
        $checklistTasksAdded = ChecklistTasksAdded::fromArray($data);
        $this->assertEquals($data, $checklistTasksAdded->toArray());
    }
}
