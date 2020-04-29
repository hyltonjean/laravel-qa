@if ($questionCount > 0)
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2 class="text-secondary">{{ $questionCount . " " . Str::plural('Answer', $questionCount) }}</h2>
                </div>
                @include('partials.messages')

                <hr>
                @foreach ($answers as $answer)
                <div class="media">
                    <div class="d-flex flex-column vote-controls">
                        <a title="This answer is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit()">
                            <i class="fa fa-caret-up fa-4x"></i>
                        </a>
                        <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote"
                            method="POST" style="display: none;">
                            @csrf <input type="hidden" name="vote" value="1">
                        </form>

                        <span class="votes_count">{{ $answer->votes_count }}</span>

                        <a title="This answer is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit()">
                            <i class="fa fa-caret-down fa-4x"></i>
                        </a>
                        <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote"
                            method="POST" style="display: none;">
                            @csrf <input type="hidden" name="vote" value="-1">
                        </form>
                        @include('shared.accept', [
                        'model' => $answer
                        ])
                    </div>
                    <div class="media-body mr-3">
                        <div class="mb-5">{!! $answer->body_html !!}</div>
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-auto">
                                    @can('update', $answer)
                                    <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                        class="hover btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can('delete', $answer)
                                    <form class="form-delete"
                                        action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4 d-flex flex-column align-items-end">
                                @include('shared.author', [
                                'model' => $answer,
                                'label' => 'answered'
                                ])
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
@endif
