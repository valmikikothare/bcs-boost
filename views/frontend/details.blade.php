@extends('layouts.web_layout')

@section('content')


<main class="bg-body-tertiary py-5">
    <section>
        <div class="container">
            @isset($forumData)
            <div class="pb-2">
                <h4 class="pb-2">{{ ucwords($forumData->title) }}</h4>



                <div class="small d-flex flex-wrap gap-3">
                    <span><i class="fa-regular fa-user"></i> Starter: {{ ucwords($forumData->user->name) }}</span>
                    <a href="#"><i class="fa-regular fa-clock"></i> Start date: {{ date('M d, Y', strtotime($forumData->created_at)) }}</a>
                    @if (Auth::check())
                    <form action="{{ route('like', ['type' => 'question', 'id' => $forumData->id]) }}" method="POST" class="like-dislike-form d-inline">
                        @csrf
                        <button type="submit" class="invisible-button">
                            <i class="fa-solid fa-heart @if ($forumData->likedByUser(Auth::user())) active @endif" style="color: red;"></i>
                        </button>
                    </form>
                    <div class="d-flex align-items-center ml-2">
                        <span class="likes-count">{{ $forumData->likes_count }}</span>
                    </div>
                    @else
                    <div class="d-flex align-items-center ml-2">
                        <i class="fa-solid fa-heart" style="color: red; margin-right: 7px;"></i>
                        <span class="likes-count">{{ $forumData->likes_count }}</span>
                    </div>
                    @endif

                </div>

                <div class="forum-content mt-3" style="word-wrap: break-word;">
                    <!-- Display forum content here with preserved formatting -->
                    {!! $forumData->content !!} <!-- Assuming "content" is the property containing the forum content -->
                </div>
            </div>



            @if(Auth::User() !="" && !empty(Auth::User()))
            <div class="pb-3">
                <form action="{{ route('views.store_forum_answer') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <input type="hidden" name="forum_id" value="{{ $forumData->id }}">
                        <div class="col-md-12">
                            <label class="form-label">Enter Answer</label>
                            <div id="editor">
                                <textarea name="answer" class="ckeditor form-control" placeholder="Enter Answer"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div>
                                <button type="submit" class="btn btn-primary">{{ __('frontend.submit') }}</button>
                                <a href="{{ route('views.forums') }}" class="btn btn-secondary">Back</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @endif
            @if (count($forumData->forumansers) > 0)
            @foreach ($forumData->forumansers as $answers)

            <div class="mb-3">
                <div class="row g-0">
                    <div class="col-md-4 col-lg-3 bg-warning-subtle">
                        <div class="p-3">
                            <div class="text-center pb-2">
                                <div class="pb-2 new_member_img">
                                    @if($answers->answeruser->image)
                                    <img src="{{ env('AWS_URL').env('AWS_S3_FOLDER_USER').$answers->answeruser->image }}" class="img-fluid" alt="user-img" />
                                    @else
                                    <img src="{{ asset('images/user/user.png') }}" class="img-fluid" alt="user-img" />
                                    @endif
                                </div>
                                <h6>{{ ucwords($answers->answeruser->name) }}</h6>
                                <small>{{ ucwords($answers->answeruser->email) }}</small>
                            </div>
                            <div class="user_join_date">
                                <ul class="list-unstyled small">
                                    <li><span>Joined :</span> <span>{{date('M d, Y h:i:s',strtotime($answers->answeruser->created_at))}}</span></li>
                                    {{-- <li><span>Messages :</span> <span>2</span></li> --}}
                                    {{-- <li><span>Location :</span> <span>UK</span></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="bg-white p-3 content_div position-relative">
                            <!-- ... -->
                            <div class="detail_content">
                                <p>{!! $answers->answer !!}</p>
                                <h6 class="fw-semibold pb-2">Contact details : <a href="">{{ ucwords($answers->answeruser->name) }}</a></h6>
                                <h6 class="fw-semibold pb-2 text-primary">{{ date('M d, Y h:i:s',strtotime($answers->created_at)) }}</h6>

                                @if (Auth::check() && $answers->answeruser->id === Auth::user()->id)
                                <div>
                                    <a href="{{ route('views.editreply', ['id' => $answers->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('views.deletereply', ['id' => $answers->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="alert alert-danger p-3">
                <h5 class="text-center ">Not Answer yet.</h5>
            </div>
            @endif
            @else
            <div class="alert alert-danger p-3">
                <h5 class="text-center ">Forum Data not found.</h5>
            </div>
            @endisset
        </div>
    </section>
</main>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.like-form').on('submit', function(event) {
            event.preventDefault();

            const form = $(this);
            const likesCountElement = form.closest('.pb-2').find('.likes-count');
            const likeButton = form.find('.like-button');
            const url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                dataType: 'json', // Specify JSON data type
                success: function(response) {
                    // Toggle between "Like" and "Dislike" based on the button text
                    if (likeButton.text() === 'Like') {
                        likeButton.text('Dislike');
                        likesCountElement.text(response.likesCount);
                    } else {
                        likeButton.text('Like');
                        likesCountElement.text(response.likesCount);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>



@endsection