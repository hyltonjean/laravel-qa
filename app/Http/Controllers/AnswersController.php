<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question)
    {
        $question->answers()->create(
            request()->validate([
                'body' => 'required'
            ]) + ['user_id' => auth()->id()]
        );

        session()->flash('success', 'Your answer has been submitted successfully');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', compact(['question', 'answer']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,  Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update(request()->validate([
            'body' => 'required'
        ]));

        session()->flash('success', 'Your answer has been updated successfully');

        return redirect(route('questions.show', $question->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        session()->flash('success', 'Your answer has been deleted successfully');

        return back();
    }
}
