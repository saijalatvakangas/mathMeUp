<?php declare(strict_types=1);

namespace App\Entities\Calculations;

use App\Entities\Question;

interface Calculation
{
    /**
     * Creates a calculation and generates answer options to the calculation.
     * Returns a calculation string and array of answer options.
     *
     * @param int $level
     * @return Question
     */
    public function createCalculation(int $level): Question;
}
