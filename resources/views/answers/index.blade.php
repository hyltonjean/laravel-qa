<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $questionCount . " " . Str::plural('Answer', $questionCount) }}</h2>
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
                        @can('accept', $answer)
                        <a title="Mark this answer as best answer" class="vote-accepted"
                            onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit()">
                            <svg aria-hidden="true" class="svg-icon iconCheckmarkLg" width="36" height="36"
                                viewBox="0 0 36 36" fill="{{ $answer->status }}">
                                <path d="M6 14l8 8L30 6v8L14 30l-8-8v-8z"></path>
                            </svg>
                        </a>
                        <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}"
                            method="POST" style="display: none;">
                            @csrf
                        </form>
                        @else
                        @if ($answer->is_best)
                        <a title="The question owner accepted this answer as best answer" class="vote-accepted">
                            <svg aria-hidden="true" class="svg-icon iconCheckmarkLg" width="36" height="36"
                                viewBox="0 0 36 36" fill="{{ $answer->status }}">
                                <path d="M6 14l8 8L30 6v8L14 30l-8-8v-8z"></path>
                            </svg>
                        </a>
                        @endif
                        @endcan
                    </div>
                    <div class="media-body mr-3">
                        {!! $answer->body_html !!}
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
                            <div class="col-4">
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
