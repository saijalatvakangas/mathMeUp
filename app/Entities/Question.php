<?php declare(strict_types=1);

namespace App\Entities;

class Question
{
    private string $question;

    /**
     * @var array|AnswerOption
     */
    private array $answerOptions;

    public function __construct(string $question, array $answerOptions)
    {
        $this->question = $question;
        $this->answerOptions = $answerOptions;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @return AnswerOption|array
     */
    public function getAnswerOptions(): array
    {
        return $this->answerOptions;
    }
}
