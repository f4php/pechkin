<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Chat;
use F4\Pechkin\DataType\ChecklistTask;
use F4\Pechkin\DataType\User;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChecklistTaskTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('checklist_task_full.json');
        $checklistTask = ChecklistTask::fromArray($data);

        $this->assertInstanceOf(ChecklistTask::class, $checklistTask);
        $this->assertNotEmpty($checklistTask->text_entities);
        $this->assertInstanceOf(User::class, $checklistTask->completed_by_user);
        $this->assertInstanceOf(Chat::class, $checklistTask->completed_by_chat);
        $this->assertSame(123456789, $checklistTask->id);
        $this->assertSame('Hello, World!', $checklistTask->text);
        $this->assertSame(42, $checklistTask->completion_date);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('checklist_task_minimal.json');
        $checklistTask = ChecklistTask::fromArray($data);

        $this->assertInstanceOf(ChecklistTask::class, $checklistTask);
        $this->assertNull($checklistTask->text_entities);
        $this->assertNull($checklistTask->completed_by_user);
        $this->assertNull($checklistTask->completed_by_chat);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('checklist_task_minimal.json');
        $checklistTask = ChecklistTask::fromArray($data);
        $this->assertEquals($data, $checklistTask->toArray());
    }
}
