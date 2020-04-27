<?php

namespace App\Http\Controllers;

use App\Answer;

class AcceptAnswersController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $this->authorize('accept', $answer);

        $answer->question->acceptBestAnswer($answer);

        return back();
    }
}
