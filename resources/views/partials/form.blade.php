@csrf
<div class="form-group">
    <label for="question-title">Question Title</label>
    <input type="text" name="title" id="question-title" value="{{ old('title', $question->title) }}"
        class="form-control @error('title') is-invalid @enderror">
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="question-body">Explain your Question</label>
    <textarea type="text" name="body" id="question-body" class="form-control @error('body') is-invalid @enderror"
        rows="10">{{ old('body', $question->body) }}</textarea>
    @error('body')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-outline-primary btn-lg form-control">{{ $buttonText }}</button>
</div>
