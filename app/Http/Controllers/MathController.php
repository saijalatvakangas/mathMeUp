<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entities\AnswerOption;
use App\Entities\Calculations\Addition;
use App\Entities\Calculations\Calculation;
use App\Entities\Calculations\Subtraction;
use App\Entities\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MathController extends Controller
{
    public function createQuestion(Request $request): JsonResponse
    {
        $level = (int)$request->get('level');
        $questionData = $this->chooseCalculation()->createCalculation($level);

        return response()->json([
            'question'=>$questionData->getQuestion(),
            'answerOptions'=> $this->formAnswerOptionJson($questionData->getAnswerOptions()),
            'level'=> $request->get('level')
        ]);
    }


    protected function chooseCalculation(): Calculation
    {
        $option = random_int(1,2);
        if ($option === 1) {
            return new Addition();
        }
        return new Subtraction();
    }

    /**
     * @param array|AnswerOption $answerOptions
     * @return array
     */
    protected function formAnswerOptionJson(array $answerOptions): array
    {
        $answerArray = [];

        /**
         * @var AnswerOption $answerOption
         */
        foreach ($answerOptions as $answerOption) {
            $answerArray[] =
            [
                'number' => $answerOption->getNumber(),
                'isCorrect' => $answerOption->isCorrect()
            ];
        }
        return $answerArray;
    }
}
