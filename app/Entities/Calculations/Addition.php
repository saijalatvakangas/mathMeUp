<?php declare(strict_types=1);

namespace App\Entities\Calculations;

use App\Entities\Question;

class Addition extends BaseCalculation implements Calculation
{
    /**
     * @param int $level
     * @return Question
     * @throws \Exception
     */
    public function createCalculation(int $level): Question
    {
        $operation = $this->createSpecificTypeOfCalculation($level, '+');

        return new Question($operation[self::KEY_OPERATION], $this->createAnswerOptions($operation));
    }
}
