@extends('app')

@section('app_content')
    <section id="dashboard" class="dashboard mt-4">
        <div class="container">
            <div class="row">
                @include('partials._dashboard-sidebar')

                <main role="main" class="col-md ml-4 py-3 bg-white shadow-sm">
                    <div class="row">
                        <div class="col">
                            <h5 class="font-weight-bold">Dashboard</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-4 mb-5">
                                        <div class="card border-0 shadow-sm text-center">
                                            <div class="card-body px-0 pb-0">
                                                <p class="display-4 font-weight-bold text-dark">{{ $profile->resumes->count() }}</p>
                                                <h5 class="lead text-secondary">My Resumes</h5>

                                                <a class="btn btn-dark mt-2 py-3 w-100 rounded-0" href="{{ route('dashboard.resumes', ['username' => $profile->username]) }}">View</a>
                                            </div>
                                        </div>
                                    </div>

                                    @if ((int) Auth::id() === (int) $profile->id)
                                        @if (! is_null($total_resume_count))
                                            <div class="col-md-4 mb-5">
                                                <div class="card border-0 shadow-sm text-center">
                                                    <div class="card-body px-0 pb-0">
                                                        <p class="display-4 font-weight-bold text-dark">{{ $total_resume_count }}</p>
                                                        <h5 class="lead text-secondary">Total Resumes</h5>

                                                        <a class="btn btn-dark mt-2 py-3 w-100 rounded-0" href="{{ route('dashboard.resumes.all') }}">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (! is_null($total_user_count))
                                            <div class="col-md-4 mb-5">
                                                <div class="card border-0 shadow-sm text-center">
                                                    <div class="card-body px-0 pb-0">
                                                        <p class="display-4 font-weight-bold text-dark">{{ $total_user_count }}</p>
                                                        <h5 class="lead text-secondary">Total Users</h5>

                                                        <a class="btn btn-dark mt-2 py-3 w-100 rounded-0" href="{{ route('dashboard.users') }}">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                    <div class="col-md-4 mb-5">
                                        <div class="card border-0 shadow-sm text-center">
                                            <div class="card-body px-0 pb-0">
                                                <p class="display-4 font-weight-bold text-primary">
                                                    <i class="fa-dropbox"></i>
                                                </p>

                                                <h4 class="lead text-secondary">Cloud Connection</h4>

                                                <a class="btn btn-primary mt-2 py-3 w-100 rounded-0" href="#">View</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-5">
                                        <div class="card border-0 shadow-sm text-center">
                                            <div class="card-body px-0 pb-0">
                                                <p class="display-4 font-weight-bold text-warning">FREE</p>

                                                <h4 class="lead text-secondary">My Plan</h4>

                                                <a class="btn btn-warning mt-2 py-3 w-100 rounded-0" href="#">View</a>
                                            </div>
                                        </div>
                                    </div>

                                    @if (! is_null($total_revenue))
                                        <div class="col-md-4 mb-5">
                                            <div class="card border-0 shadow-sm text-center">
                                                <div class="card-body px-0 pb-0">
                                                    <p class="display-4 font-weight-bold text-warning">
                                                        <sup class="text-muted">$</sup>{{ (float) $total_revenue }}
                                                    </p>

                                                    <h4 class="lead text-secondary">Total Revenue</h4>

                                                    <a class="btn btn-warning mt-2 py-3 w-100 rounded-0" href="#">View</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
@endsection