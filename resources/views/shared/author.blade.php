<span class="text-muted">{{ $label . " " . $model->created_date }}</span>
<div class="media mt-2">
    <a href="{{ $model->user->url }}" class="pr-2">
        <img class="rounded" src="{{ $model->user->avatar }}">
    </a>
    <div class="media-body mt-1">
        <a class="text-dark text-decoration-none" href="{{ $model->user->url }}">{{ $model->user->name }}</a>
    </div>
</div>
