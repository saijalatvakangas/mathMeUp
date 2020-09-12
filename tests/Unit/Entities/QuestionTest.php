<?php declare(strict_types=1);

namespace Entities;

use App\Entities\AnswerOption;
use App\Entities\Question;
use Mockery;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    private Question $question;
    private string $expectedQuestion;
    private array $expectedAnswerOptions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedQuestion = '3 + 4';
        $this->expectedAnswerOptions = [Mockery::mock(AnswerOption::class), Mockery::mock(AnswerOption::class)];
        $this->question = new Question($this->expectedQuestion, $this->expectedAnswerOptions);
    }

    public function testGetQuestion_shouldReturnExpectedQuestion(): void
    {
        self::assertEquals($this->expectedQuestion, $this->question->getQuestion());
    }

    public function testGetAnswerOptions_shouldReturnExpectedAnswerOptions(): void
    {
        self::assertEquals($this->expectedAnswerOptions, $this->question->getAnswerOptions());
    }
}
