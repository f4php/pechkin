<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use F4\Pechkin\DataType\InputChecklist;
use F4\Tests\DataType\FixtureAwareTrait;
use PHPUnit\Framework\TestCase;

final class InputChecklistTest extends TestCase
{
    use FixtureAwareTrait;

    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = $this->loadFixture('input_checklist_full.json');
        $inputChecklist = InputChecklist::fromArray($data);

        $this->assertInstanceOf(InputChecklist::class, $inputChecklist);
        $this->assertNotEmpty($inputChecklist->tasks);
        $this->assertNotEmpty($inputChecklist->title_entities);
        $this->assertSame('Test Title', $inputChecklist->title);
        $this->assertSame('HTML', $inputChecklist->parse_mode);
        $this->assertSame(true, $inputChecklist->others_can_add_tasks);
        $this->assertSame(true, $inputChecklist->others_can_mark_tasks_as_done);
    }

    public function testFromArrayWithMinimalData(): void
    {
        $data = $this->loadFixture('input_checklist_minimal.json');
        $inputChecklist = InputChecklist::fromArray($data);

        $this->assertInstanceOf(InputChecklist::class, $inputChecklist);
        $this->assertNull($inputChecklist->parse_mode);
        $this->assertNull($inputChecklist->title_entities);
        $this->assertNull($inputChecklist->others_can_add_tasks);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = $this->loadFixture('input_checklist_minimal.json');
        $inputChecklist = InputChecklist::fromArray($data);
        $this->assertEquals($data, $inputChecklist->toArray());
    }
}
