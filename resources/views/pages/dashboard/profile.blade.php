@extends('app')

@section('app_content')
    <section id="dashboard" class="dashboard mt-4">
        <div class="container">
            @if ($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-4">
                        <div class="alert alert-danger mb-0">
                            <ul class="mb-0">
                                <li>{{ $errors->first() }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                @include('partials._dashboard-sidebar')

                <main role="main" class="col-md ml-4 py-3 bg-white shadow-sm">
                    <form name="profile" action="{{ route('dashboard.profile', ['username' => $profile->username]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row align-content-center">
                            <div class="col">
                                <h5 class="font-weight-bold">Profile</h5>
                            </div>

                            <div class="col text-right">
                                <button class="btn btn-outline-primary" type="submit">Save</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mt-3">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="col-form-label font-weight-bold" for="email-address">Email address</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input name="email" id="email-address" type="text" class="form-control" placeholder="example@mail.com" value="{{ $profile->email }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="col-form-label font-weight-bold" for="username">Username</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input name="username" id="username" type="text" class="form-control disabled" placeholder="john.smith" value="{{ $profile->username }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="col-form-label font-weight-bold" for="full-name">Full name</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input name="name" id="full-name" type="text" class="form-control" placeholder="John Smith" value="{{ $profile->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label class="col-form-label font-weight-bold" for="new-password">New Password</label>
                                        </div>

                                        <div class="col-sm-8">
                                            <input name="password" id="new-password" type="password" class="form-control" placeholder="New Password">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mt-3">
                                    <div class="text-center">
                                        @if (! empty($profile->avatar))
                                            <img class="rounded-circle mx-auto d-block" alt="120x120" style="width: 120px; height: 120px;" src="{{ asset('uploads/avatars/' . $profile->avatar ) }}">
                                        @else
                                            <img data-src="holder.js/120x120" class="rounded-circle mx-auto d-block" alt="120x120" style="width: 120px; height: 120px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16465795616%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16465795616%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274%22%20y%3D%22104.8%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
                                        @endif

                                        <div class="input-group mx-auto mt-3" style="max-width: 200px;">
                                            <div class="custom-file">
                                                <input name="avatar" type="file" class="custom-file-input" id="avatar">

                                                <label class="custom-file-label text-left" for="avatar">Select avatar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </main>
            </div>
        </div>
    </section>
@endsection