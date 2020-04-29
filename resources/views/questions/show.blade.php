@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2 class="text-secondary">{{ $question->title }}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back to
                                    Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        @include('shared.vote', [
                        'model' => $question
                        ])
                        <div class="media-body">
                            <div class="mb-5">{!! $question->body_html !!}</div>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4 d-flex flex-column align-items-end">
                                    @include('shared.author', [
                                    'model' => $question,
                                    'label' => 'asked'
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('answers.index', [
    'answers' => $question->answers,
    'questionCount' => $question->answers_count
    ])

    @include('answers.create')

</div>
@endsection
