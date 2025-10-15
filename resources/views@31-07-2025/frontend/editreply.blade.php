@extends('layouts.web_layout')

@section('content')

<main class="bg-body-tertiary py-5">
    <section>
        <div class="container">
            <div class="pb-2">
                <h4 class="pb-2">{{ucwords($reply->title)}}</h4>
                <!-- ... -->
            </div>
            <div class="pb-3">
                <form action="{{ route('views.updatereply', ['id' => $reply->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row g-3">
                        <input type="hidden" name="forum_id" value="{{ $reply->id }}">
                        <div class="col-md-12">
                            <label class="form-label">Edit Answer</label>
                            <div id="editor">
                                <textarea name="answer" class="ckeditor form-control" placeholder="Edit Answer">{{ $reply->answer }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div>
                                <button type="submit" class="btn btn-primary">{{ __('frontend.submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@endsection
