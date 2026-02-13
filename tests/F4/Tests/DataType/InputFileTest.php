<?php

declare(strict_types=1);

namespace F4\Tests\DataType;

use PHPUnit\Framework\TestCase;
use F4\Pechkin\DataType\InputFile;

use function base64_encode;

final class InputFileTest extends TestCase
{
    public function testFromArrayCreatesCorrectStructure(): void
    {
        $data = [
            'filename' => 'test.txt',
            'content' => 'abcdefg',
        ];
        $inputFile = InputFile::fromArray($data);
        $this->assertInstanceOf(InputFile::class, $inputFile);
    }

    public function testFromArrayToArrayRoundtrip(): void
    {
        $data = [
            'filename' => 'test.txt',
            'content' => 'abcdefg',
        ];
        $inputFile = InputFile::fromArray($data);
        $this->assertEquals($data, $inputFile->toArray());
    }
}
