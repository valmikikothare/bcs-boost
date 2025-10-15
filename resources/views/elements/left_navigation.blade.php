<div class="bg-white shadow-sm py-2 rounded">
    <ul class="sidebarlinks">
        {{-- <li>
            <a href="{{ route('user.user_dashboard') }}"
                class="{{ request()->routeIs('user.user_dashboard') ? 'active' : '' }}"><i
                    class="fa-solid fa-display"></i>{{ __('frontend.dashboard') }}</a>
        </li> --}}

        <li>
            <a href="{{ route('user.availableslots') }}"
                class="{{ request()->routeIs('user.availableslots') ? 'active' : '' }}"><i
                    class="fa-solid fa-clipboard-list"></i>Lead a Session</a>
        </li>


        {{-- <li>
            <a href="{{ route('user.leadmanagement') }}"
                class="{{ request()->routeIs('user.leadmanagement') ? 'active' : '' }}"><i
                    class="fa-solid fa-clipboard-list"></i>Lead Management</a>
        </li> --}}


        <li>
            <a href="{{ route('user.book_session_list') }}"
                class="{{ request()->routeIs('user.book_session_list') ? 'active' : '' }}"><i
                    class="fa-solid fa-clipboard-list"></i>Book a Session</a>
        </li>


        {{-- <li>
            <a href="{{ route('user.bookingHistorylist') }}"
                class="{{ request()->routeIs('user.bookingHistorylist') ? 'active' : '' }}"><i
                    class="fa-solid fa-clipboard-list"></i>Booking History</a>
        </li> --}}


        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('user.my_sessions') ? 'active' : '' }}"
                href="{{ route('user.my_sessions') }}">
                <i class="fa-solid fa-clipboard-list"></i> My Sessions
            </a>
        </li>

 



        <li>
            <a href="{{ route('userprofile') }}" class="{{ request()->routeIs('userprofile') ? 'active' : '' }}"><i
                    class="fa-solid fa-user"></i>{{ __('frontend.profile') }}</a>
        </li>
        <li>
            <a href="{{ route('changepassword') }}"
                class="{{ request()->routeIs('changepassword') ? 'active' : '' }}"><i
                    class="fa-solid fa-key"></i>{{ __('frontend.change_pass') }}</a>
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
</div>
