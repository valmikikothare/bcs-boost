@extends('layouts.web_layout')

@section('content')

<main>

    <!-- modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('frontend.model') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                    <form action="{{route('views.store_forum')}}" method="POST" onsubmit="return validateForm()">
    @csrf
    <div class="row g-3">
        <div class="col-md-12">
            <label class="form-label">{{ __('frontend.title') }}</label>
            <input type="text" class="form-control" name="title" required />
        </div>
        <div class="col-md-12">
            <label class="form-label">{{ __('frontend.description') }}</label>
            <div id="editor">
                <textarea name="content" id="question_desc" class="ckeditor form-control" placeholder="{{ __('frontend.description') }}" required></textarea>
                <span class="text-danger" style="display: none;" id="description_error">Please fill in this field</span>
            </div>
        </div>

        <div class="col-md-12">
            <div>
                <button type="submit" id="submit_btn" class="btn btn-primary">{{ __('frontend.submit') }}</button>
            </div>
        </div>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal -->

    <section class="bg-body-tertiary py-5">
        <div class="container">
            <div class="row g-3 g-lg-4">
                <div class="col-md-12">

                    {{-- <div>
                    <div class="d-lg-flex gap-3">
                        <div class="flex-grow-1 pb-2 pb-lg-0">
                            <div class="alert alert-success p-1 d-inline-block">
                                <h2 class="fw-normal pb-1">{{ __('frontend.eating') }}</h2>
                </div>

                <p class="small">{{ __('frontend.disorders_forum') }}</p>
            </div>

        </div>
        </div> --}}
        </div>

        <div class="col-md-12">
            <div class="d-flex flex-wrap gap-3 justify-content-between">
                <div class="pagination_div">
                    <nav aria-label="...">
                        {{ $forums->links() }}

                    </nav>
                </div>
                @if(Auth::User() !="" && !empty(Auth::User()))
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
                        Question</button>
                </div>
                @endif
                {{-- <div class="dropdown_btn">
                        <div class="dropdown text-end">
                            <button class="btn btn-primary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                                 {{ __('frontend.categories') }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">{{ __('frontend.action') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('frontend.another_action') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ __('frontend.else_here') }}</a></li>
                </ul>
            </div>
        </div> --}}
        </div>
        </div>

        @if(count($forums) > 0)
        @foreach ($forums as $item)
        @if(!empty($item->user))
        <div class="col-md-12">
            <div class="border rounded p-3">
                <div class="row g-3">
                    <div class="col-lg-6 col-xl-7">
                        <div class="user_question d-flex gap-3">
                            <span class="flex-shrink-0">
                                @if($item->user !== null && $item->user->image)
                                <img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_USER').$item->user->image }}" class="img-fluid" alt="user-img" />
                                @else
                                <img src="{{ asset('images/user/user.png') }}" class="img-fluid" alt="user-img" />
                                @endif
                            </span>

                            <div class="forums_text_div">
                                <p><a href="{{ route('views.forumdetails',[base64_encode($item->id)]) }}">{{$item->title}}</a>
                                </p>

                                <div class="small d-flex gap-2">
                                    <span class="">{{$item->user->name}}</span>
                                    <a href="#">{{date('M d, Y',strtotime($item->created_at))}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-5">
                        <div class="row g-3">
                            <div class="col-sm-4 col-6">
                                <div class="d-flex gap-3">
                                    <span class="flex-shrink-0"><i class="fa-solid fa-thumbtack"></i></span>
                                    <div class="flex-grow-1">
                                        <a href="{{ route('views.forumdetails',[base64_encode($item->id)]) }}">{{ __('frontend.replies') }}</a>
                                        {{-- <small>{{ __('frontend.views') }}</small> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6">
                                <div>
                                    <p>{{$item->answers_count}}</p>
                                    {{-- <small>10</small> --}}
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="question_date d-flex gap-3 align-items-center">
                                    <div class="flex-grow-1 text-end">
                                        <p><a href="#">{{date('M d, Y',strtotime($item->created_at))}}</a></p>
                                        <small>{{$item->user->name}}</small>
                                    </div>
                                    <span class="flex-shrink-0">
                                        @if($item->user->image)
                                        <img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_USER').$item->user->image }}" class="img-fluid" alt="user-img" />
                                        @else
                                        <img src="{{ asset('images/user/user.png') }}" class="img-fluid" alt="user-img" />
                                        @endif </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @else
        <div class="alert alert-danger p-3">
            <h5 class="text-secondary text-center">{{ __('frontend.no_forum_added_yet') }}</h5>
        </div>
        @endif


        </div>
        </div>
    </section>
</main>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<!-- <script>
    // Initialize CKEditor
    CKEDITOR.replace('question_desc');

    // Add an event listener to monitor changes in the CKEditor content
    CKEDITOR.instances.question_desc.on('change', function() {
        const content = CKEDITOR.instances.question_desc.getData().trim();
        if (content != "") {
            $('#submit_btn').attr('disabled', false);
            $('#description_error').hide();
        } else {
            $('#submit_btn').attr('disabled', true);
            $('#description_error').show();
        }
    });
</script> -->


<script>
    // Initialize CKEditor
    CKEDITOR.replace('question_desc');

    // Validate the form before submission
    function validateForm() {
        const content = CKEDITOR.instances.question_desc.getData().trim();
        if (content === "") {
            $('#description_error').show();
            return false; // Prevent form submission
        } else {
            $('#description_error').hide();
            return true; // Allow form submission
        }
    }
</script>

@endsection