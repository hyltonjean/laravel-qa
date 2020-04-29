@auth
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                <hr>
                <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body"
                            rows="7">{{ old('body') }}</textarea>
                    </div>
                    @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-lg form-control">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth
