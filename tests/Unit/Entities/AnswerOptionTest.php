<?php declare(strict_types=1);

namespace Entities;

use App\Entities\AnswerOption;
use Tests\TestCase;

class AnswerOptionTest extends TestCase
{
    private AnswerOption $answerOption;
    private int $expectedNumber;
    private bool $expectedBoolean;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedNumber = -3;
        $this->expectedBoolean = false;
        $this->answerOption = new AnswerOption($this->expectedNumber, $this->expectedBoolean);
    }

    public function testGetNumber_shouldReturnExpectedNumber(): void
    {
        self::assertEquals($this->expectedNumber, $this->answerOption->getNumber());
    }

    public function testIsCorrect_shouldReturnExpectedBoolean(): void
    {
        self::assertEquals($this->expectedBoolean, $this->answerOption->isCorrect());
    }
}
