<!-- header section start  -->
<header class="header main-header shadow-sm">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home_page') }}"><img src="{{asset('images/user/WhiteLogo.png')}}"
                    class="img-fluid" width="180" /></a>
            <!-- <form action="{{ route('set-locale') }}" method="POST" id="language-selector">
    @csrf
    <select name="locale" class="border-0 outline-0 mx-3 mt-2" onchange="this.form.submit()">
        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
        <option value="nl" {{ app()->getLocale() === 'nl' ? 'selected' : '' }}>Dutch</option>
    </select>
 </form> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>



            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-lg-3">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">{{ __('frontend.home') }}</a>
                    </li> -->


                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('views.faq') }}">FAQ's</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.howtousethissite') }}">How to use this site?</a>
                    </li>

                    <li class="nav-item">
                        @if (Route::has('login'))
                            @auth
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(auth()->user()->image)
                                        <img src="{{ asset('/admin/assets/images/' . auth()->user()->image) }}"
                                            class="menuuserdropdown rounded-pill" />
                                    @else
                                        <img src="{{ asset('images/user/user.png') }}" class="menuuserdropdown" />
                                    @endif
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li><a class="dropdown-item"
                                            href="{{ route('user.my_sessions')}}">{{ __('frontend.session') }}</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('userprofile')}}">{{ __('frontend.profile') }}</a></li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa-solid fa-power-off"></i> {{ __('frontend.logout') }}
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">{{ __('frontend.login') }}</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">{{ __('frontend.register') }}</a>
                                @endif
                            @endauth
                        @endif
                    </li>


                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- header section end  -->