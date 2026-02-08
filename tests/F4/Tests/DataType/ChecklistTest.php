<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\Checklist;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class ChecklistTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('checklist_full.json');
        $checklist = Checklist::fromArray($data);

        $this->assertInstanceOf(Checklist::class, $checklist);
        $this->assertNotEmpty($checklist->tasks);
        $this->assertNotEmpty($checklist->title_entities);
        $this->assertSame('Test Title', $checklist->title);
        $this->assertSame(true, $checklist->others_can_add_tasks);
        $this->assertSame(true, $checklist->others_can_mark_tasks_as_done);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('checklist_minimal.json');
        $checklist = Checklist::fromArray($data);

        $this->assertInstanceOf(Checklist::class, $checklist);
        $this->assertNull($checklist->title_entities);
        $this->assertNull($checklist->others_can_add_tasks);
        $this->assertNull($checklist->others_can_mark_tasks_as_done);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('checklist_minimal.json');
        $checklist = Checklist::fromArray($data);
        $this->assertEquals($data, $checklist->toArray());
    }
}
