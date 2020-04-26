@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{ $question->title }}</h2>
                            <div class="ml-auto">
                                <a href="{{ route('questions.index') }}" class="btn btn-outline-secondary">Back to
                                    Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is useful" class="vote-up"><i class="fa fa-caret-up fa-4x"></i></a>
                            <span class="votes_count">1230</span>
                            <a title="This question is not useful" class="vote-down off"><i
                                    class="fa fa-caret-down fa-4x"></i></a>
                            <a title="Click to mark as favorite question (Click again to undo)"
                                class="favorite mt-1 favorited"><svg aria-hidden="true" class="svg-icon iconStar"
                                    width="18" height="18" viewBox="0 0 18 18" fill="#bbc0c4">
                                    <path
                                        d="M9 12.65l-5.29 3.63 1.82-6.15L.44 6.22l6.42-.17L9 0l2.14 6.05 6.42.17-5.1 3.9 1.83 6.16L9 12.65z">
                                    </path>
                                </svg><span class="favorites-count">123</span></a>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="d-flex flex-column align-items-end">
                                <span class="text-muted">Asked {{ $question->created_date }}</span>
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}" class="pr-2">
                                        <img class="rounded-circle" src="{{ $question->user->avatar }}">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{ $question->answers_count . " " . Str::plural('Answer', $question->answers_count) }}</h2>
                    </div>
                    <hr>
                    @foreach ($question->answers as $answer)

                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful" class="vote-up"><i class="fa fa-caret-up fa-4x"></i></a>
                            <span class="votes_count">1230</span>
                            <a title="This answer is not useful" class="vote-down off"><i
                                    class="fa fa-caret-down fa-4x"></i></a>
                            <a title="Mark this answer as best answer" class="vote-accepted"><svg aria-hidden="true"
                                    class="svg-icon iconCheckmarkLg" width="36" height="36" viewBox="0 0 36 36"
                                    fill="#48a868">
                                    <path d="M6 14l8 8L30 6v8L14 30l-8-8v-8z"></path>
                                </svg></a>
                        </div>
                        <div class="media-body mr-3">
                            {!! $answer->body_html !!}
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <span class="text-muted">Answered {{ $answer->created_date }}</span>
                            <div class="media mt-2">
                                <a href="{{ $answer->user->url }}" class="pr-2">
                                    <img class="rounded-circle" src="{{ $answer->user->avatar }}">
                                </a>
                                <div class="media-body mt-1">
                                    <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!$loop->last)
                    <hr>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
