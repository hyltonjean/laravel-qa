<a title="Click to mark as favorite question (Click again to undo)" class="favorite mt-1
{{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}"
    onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit()">
    <svg aria-hidden="true" class="svg-icon iconStar" width="25" height="25" viewBox="0 0 18 18"
        fill="{{ Auth::guest() ? '#6c757d' : ($model->is_favorited ? '#f6993f' : '#6c757d') }}">
        <path d="M9 12.65l-5.29 3.63 1.82-6.15L.44 6.22l6.42-.17L9 0l2.14 6.05 6.42.17-5.1 3.9 1.83 6.16L9 12.65z">
        </path>
    </svg>
    <span class="favorites-count mt-1" style="{{ $model->is_favorited ? 'color: #f6993f;' : 'color: #6c757d;' }}">
        <h6>{{ $model->favorites_count }}</h6>
    </span>
    <form id="favorite-question-{{ $model->id }}" action="/questions/{{ $model->id }}/favorites" method="POST"
        style="display: none;">
        @csrf
        @if ($model->is_favorited)
        @method('DELETE')
        @endif
    </form>
</a>
