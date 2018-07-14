<nav id="dashboard-sidebar" class="col-md-3 py-3 bg-dark shadow-sm">
    <div class="card bg-transparent text-center border-0">
        <div class="card-body">
            @if (! empty($profile->avatar))
                <img class="rounded-circle mx-auto d-block" style="width: 120px; height: 120px;" src="{{ $profile->avatar }}">
            @else
                <img class="rounded-circle mx-auto d-block" style="width: 120px; height: 120px;" src="{{ asset( 'uploads/avatars/default.png' ) }}">
            @endif

            <p class="card-title h5 font-weight-bold text-white mt-3">{{ $profile->name }}</p>
        </div>
    </div>

    <hr class="mt-0">

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ \Route::currentRouteName() === 'dashboard.statistics' ? 'active' : '' }}" href="{{ route('dashboard.statistics', ['username' => $profile->username]) }}">Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ \Route::currentRouteName() === 'dashboard.resumes' ? 'active' : '' }}" href="{{ route('dashboard.resumes', ['username' => $profile->username]) }}">Resumes</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ \Route::currentRouteName() === 'dashboard.profile' ? 'active' : '' }}" href="{{ route('dashboard.profile', ['username' => $profile->username]) }}">Profile</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Subscription</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Clouds</a>
        </li>

        @if ((int) Auth::id() === (int) $profile->id)
            @if ($profile->hasAnyRole(['administrator', 'moderator']))
                <li class="nav-item">
                    <a class="nav-link {{ \Route::currentRouteName() === 'dashboard.users' ? 'active' : '' }}" href="{{ route('dashboard.users') }}">Users</a>
                </li>
            @endif

            @if ($profile->hasRole(['administrator']))
                <li class="nav-item">
                    <a class="nav-link" href="#">Occupations</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.resumes.templates') }}">Templates</a>
                </li>
            @endif
        @endif
    </ul>
</nav>