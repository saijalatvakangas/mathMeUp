<?php declare(strict_types=1);

namespace App\Entities;

class AnswerOption
{
    protected int $number;
    protected bool $isCorrect;

    public function __construct(int $number, bool $isCorrect)
    {
        $this->number = $number;
        $this->isCorrect = $isCorrect;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}
