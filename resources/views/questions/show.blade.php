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

                            <a title="This question is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit()">
                                <i class="fa fa-caret-up fa-4x"></i>
                            </a>
                            <form id="up-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote"
                                method="POST" style="display: none;">
                                @csrf <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votes_count">{{ $question->votes_count }}</span>

                            <a title="This question is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit()">
                                <i class="fa fa-caret-down fa-4x"></i>
                            </a>
                            <form id="down-vote-question-{{ $question->id }}"
                                action="/questions/{{ $question->id }}/vote" method="POST" style="display: none;">
                                @csrf <input type="hidden" name="vote" value="-1">
                            </form>

                            <a title="Click to mark as favorite question (Click again to undo)" class="favorite mt-1
                                {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit()">
                                <svg aria-hidden="true" class="svg-icon iconStar" width="25" height="25"
                                    viewBox="0 0 18 18"
                                    fill="{{ Auth::guest() ? '#6c757d' : ($question->is_favorited ? '#f6993f' : '#6c757d') }}">
                                    <path
                                        d="M9 12.65l-5.29 3.63 1.82-6.15L.44 6.22l6.42-.17L9 0l2.14 6.05 6.42.17-5.1 3.9 1.83 6.16L9 12.65z">
                                    </path>
                                </svg>
                                <span class="favorites-count mt-1"
                                    style="{{ $question->is_favorited ? 'color: #f6993f;' : 'color: #6c757d;' }}">
                                    <h6>{{ $question->favorites_count }}</h6>
                                </span>
                                <form id="favorite-question-{{ $question->id }}"
                                    action="/questions/{{ $question->id }}/favorites" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @if ($question->is_favorited)
                                    @method('DELETE')
                                    @endif
                                </form>
                            </a>
                        </div>
                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
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

    @include('answers.index', [
    'answers' => $question->answers,
    'questionCount' => $question->answers_count
    ])

    @include('answers.create')

</div>
@endsection
