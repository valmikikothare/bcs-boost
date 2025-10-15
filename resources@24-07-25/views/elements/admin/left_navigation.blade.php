<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">
                <i class="nav-icon fas fa-user"></i>
                {{ Auth::user()->name }}
            </a>
        </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('admin.dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ Route::is('users.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('admin.user') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('slots.index') }}" class="nav-link {{ Route::is('slots.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>
                        Slots
                    </p>
                </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('profile.show') }}" class="nav-link {{ Route::is('profile.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file"></i>
                    {{ __('My profile') }}
                </a>

            </li>


            <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
            @csrf
                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="nav-icon fas fa-sign-out"></i>
                    {{ __('Log Out') }}
                </a>
            </form>
            </li>


        </ul>
    </nav>

    <!-- /.sidebar-menu -->

</div>
<!-- /.sidebar -->