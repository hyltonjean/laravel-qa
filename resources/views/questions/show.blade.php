@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $question->title }}</div>

                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            {{ $question->body }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
