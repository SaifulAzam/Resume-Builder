<nav class="col-md-3 py-3 bg-white shadow-sm">
    <div class="card text-center border-0">
        <div class="card-body">
            @if (! empty($profile->avatar))
                <img class="rounded-circle mx-auto d-block" alt="120x120" style="width: 120px; height: 120px;" src="{{ asset('uploads/avatars/' . $profile->avatar ) }}">
            @else
                <img data-src="holder.js/120x120" class="rounded-circle mx-auto d-block" alt="120x120" style="width: 120px; height: 120px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16465795616%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16465795616%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274%22%20y%3D%22104.8%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            @endif

            <p class="card-title h5 font-weight-bold mt-3">{{ $profile->name }}</p>
        </div>
    </div>

    <hr class="mt-0">

    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ \Route::currentRouteName() === 'dashboard.statistics' ? 'active bg-light' : '' }}" href="{{ route('dashboard.statistics', ['username' => $profile->username]) }}">Dashboard</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ \Route::currentRouteName() === 'dashboard.resumes' ? 'active bg-light' : '' }}" href="{{ route('dashboard.resumes', ['username' => $profile->username]) }}">Resumes</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ \Route::currentRouteName() === 'dashboard.profile' ? 'active bg-light' : '' }}" href="{{ route('dashboard.profile', ['username' => $profile->username]) }}">Profile</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Payments</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Clouds</a>
        </li>

        @if ($profile->hasAnyRole(['administrator', 'moderator']))
        <li class="nav-item">
            <a class="nav-link" href="#">Users</a>
        </li>
        @endif

        @if ($profile->hasRole(['administrator']))
        <li class="nav-item">
            <a class="nav-link" href="#">Occupations</a>
        </li>
        @endif
    </ul>
</nav>