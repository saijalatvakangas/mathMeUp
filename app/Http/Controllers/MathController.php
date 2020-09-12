<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entities\AnswerOption;
use App\Entities\Question;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MathController extends Controller
{
    public function createQuestion(Request $request): JsonResponse
    {
        $answerOption1 = new AnswerOption(7, true);
        $answerOption2 = new AnswerOption(8, false);
        $questionData = new Question('3 + 4', [$answerOption1, $answerOption2]);
        return response()->json([
            'question'=>$questionData->getQuestion(),
            'answerOptions'=>[
                [
                    'number' => 30,
                    'isCorrect' => false
                ],
                [
                    'number' => 50,
                    'isCorrect' => false
                ],
                [
                    'number' => 100,
                    'isCorrect' => false
                ],
                [
                    'number' => 10,
                    'isCorrect' => true
                ]
            ]
        ]);
    }
}
