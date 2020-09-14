<?php declare(strict_types=1);

namespace App\Entities;

class AnswerOption
{
    protected int $number;
    protected bool $isCorrect;

    /**
     * AnswerOption constructor.
     * @param int $number
     * @param bool $isCorrect
     */
    public function __construct(int $number, bool $isCorrect)
    {
        $this->number = $number;
        $this->isCorrect = $isCorrect;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}
