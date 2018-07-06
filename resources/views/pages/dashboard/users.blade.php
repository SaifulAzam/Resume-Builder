@extends('app')

@section('app_content')
    <section id="dashboard" class="dashboard mt-4">
        <div class="container">
            <div class="row">
                @include('partials._dashboard-sidebar')

                <main role="main" class="col-md ml-4 py-3 bg-white shadow-sm">
                    <div class="row align-content-center">
                        <div class="col">
                            <h5 class="font-weight-bold">Users</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Full name</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email address</th>
                                            <th scope="col">Created at</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($users))
                                            @foreach($users as $user)
                                                <tr>
                                                    <th scope="row">
                                                        <a href="{{ route('dashboard.statistics', ['username' => $user->username]) }}">{{ $user->name }}</a>
                                                    </th>
                                                    <td>
                                                        <span class="badge badge-pill badge-warning">{{ $user->username }}</span>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans(\Carbon\Carbon::now()) }}</td>
                                                    <td>
                                                        <div class="buttons text-right">
                                                            <div class="btn btn-sm btn-danger">
                                                                <i class="fa-trash"></i>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    <p class="card-text">Sorry! No user found.</p>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>

                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
@endsection