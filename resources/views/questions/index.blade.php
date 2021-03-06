@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1 class="text-secondary">All Questions</h1>
                        <div class="ml-auto">
                            <a href="{{ route('questions.create') }}" class="btn btn-outline-primary">Ask
                                Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('partials.messages')

                    @forelse ($questions as $question)
                    <div class="media">
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{ $question->votes_count }}</strong>
                                {{ Str::plural('vote', $question->votes_count) }}
                            </div>
                            <div class="status {{ $question->status }}">
                                <strong>{{ $question->answers_count }}</strong>
                                {{ Str::plural('answer', $question->answers_count) }}
                            </div>
                            <div class="view">
                                {{ $question->views . " " . Str::plural('view', $question->views) }}
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center">
                                <h3 class="mt-0">
                                    <a class="text-secondary text-decoration-none"
                                        href="{{ $question->url }}">{{ $question->title }}</a>
                                </h3>
                                <div class="ml-auto">
                                    @can('update', $question)
                                    <a href="{{ route('questions.edit', $question->id) }}"
                                        class="hover btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can('delete', $question)
                                    <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <p class="lead">Asked by
                                <a class="text-secondary text-decoration-none"
                                    href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                <small class="text-muted">{{ $question->created_date }}</small>
                            </p>

                            <div class="excerpt">
                                {{ $question->excerpt(300) }}
                            </div>
                        </div>
                    </div>
                    <hr>
                    @empty
                    <div class="alert alert-warning">
                        <b>Sorry</b> There are no questions available.
                    </div>
                    @endforelse

                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
