@can('accept', $model)
<a title="Mark this answer as best answer" class="vote-accepted"
    onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit()">
    <svg aria-hidden="true" class="svg-icon iconCheckmarkLg" width="36" height="36" viewBox="0 0 36 36"
        fill="{{ $model->status }}">
        <path d="M6 14l8 8L30 6v8L14 30l-8-8v-8z"></path>
    </svg>
</a>
<form id="accept-answer-{{ $model->id }}" action="{{ route('answers.accept', $model->id) }}" method="POST"
    style="display: none;">
    @csrf
</form>
@else
@if ($model->is_best)
<a title="The question owner accepted this answer as best answer" class="vote-accepted">
    <svg aria-hidden="true" class="svg-icon iconCheckmarkLg" width="36" height="36" viewBox="0 0 36 36"
        fill="{{ $model->status }}">
        <path d="M6 14l8 8L30 6v8L14 30l-8-8v-8z"></path>
    </svg>
</a>
@endif
@endcan
