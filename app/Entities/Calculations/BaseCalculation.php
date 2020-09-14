<?php declare(strict_types=1);

namespace App\Entities\Calculations;

use App\Entities\AnswerOption;
use Exception;

class BaseCalculation
{
    public const KEY_RESULT = 'result';
    public const KEY_OPERATION = 'operation';

    /**
     * Generates random numbers and puts them into string with given operator.
     * Generated numbers get higher by the value of the level parameter.
     * Returns array with calculation string and the answer to the calculation.
     *
     * @param int $level
     * @param string $operator
     * @return array
     * @throws Exception
     */
    protected function createSpecificTypeOfCalculation(int $level, string $operator): array
    {
        $firstNumber = random_int(1 + $level, 12 + $level);
        $secondNumber = random_int(1 + $level, 4 + $level);

        if ($operator === '+') {
            $result = $firstNumber + $secondNumber;
        } else {
            $result = $firstNumber - $secondNumber;
        }

        return [
            self::KEY_OPERATION => "$firstNumber $operator $secondNumber",
            self::KEY_RESULT => $result
        ];
    }

    /**
     * Creates and returns a right answer option with given number and adds boolean true.
     *
     * @param int $correctAnswer
     * @return AnswerOption
     */
    protected function createCorrectAnswerOption(int $correctAnswer): AnswerOption
    {
        return new AnswerOption($correctAnswer, true);
    }

    /**
     * Generates false answer options according to the count number.
     * Generated numbers are different from the correct answer but are within determined range.
     * Returns an array with false answer options.
     *
     * @param int $correctAnswer
     * @return array
     * @throws Exception
     */
    protected function createFalseAnswerOptions(int $correctAnswer): array
    {
        $falseAnswerOptions = [];
        $count = 3;
        $range = 5;

        for ($i = 0; $i < $count; $i++) {
            $falseNumber = $correctAnswer;
            while ($falseNumber === $correctAnswer){
                $falseNumber = random_int($correctAnswer - $range, $correctAnswer + $range);
            }
            $falseAnswerOptions[] = new AnswerOption($falseNumber, false);
        }
        return $falseAnswerOptions;
    }

    /**
     * Collects an array with false answer options and a correct answer option.
     * Shuffles the answer options order in array.
     * Returns an array with all answer options.
     *
     * @param array $operation
     * @return array
     * @throws Exception
     */
    protected function createAnswerOptions(array $operation): array
    {
        $answerOptions = $this->createFalseAnswerOptions($operation[self::KEY_RESULT]);
        $answerOptions[] = $this->createCorrectAnswerOption($operation[self::KEY_RESULT]);
        shuffle($answerOptions);

        return $answerOptions;
    }
}
