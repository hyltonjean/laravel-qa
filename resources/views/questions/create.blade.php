@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2 class="text-secondary">Ask a Question</h2>
                        <div class="ml-auto">
                            <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back to
                                Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('questions.store', $question->id) }}" method="POST">
                        @include('partials.form', ['buttonText' => 'Ask a Question'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
