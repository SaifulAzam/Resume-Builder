@extends('app')

@section('app_content')
    <section id="dashboard" class="dashboard mt-4">
        <div class="container">
            <div class="row">
                @include('partials._dashboard-sidebar')

                <main role="main" class="col-md ml-4 py-3 bg-white shadow-sm">
                    <div class="row align-content-center">
                        <div class="col">
                            <h5 class="font-weight-bold">Templates</h5>
                        </div>

                        <div class="col text-right">
                            <a class="btn btn-outline-primary" href="{{ route('dashboard.resumes.templates-upload') }}">New Template</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mt-3">
                                <div class="row">
                                    @foreach($templates as $template)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <img class="card-img-top" src="{{ $template['preview'] }}">

                                                <div class="card-body">
                                                    <div class="d-inline mr-2">
                                                        <span class="card-title text-capitalize font-weight-bold">{{ $template['name'] }}</span>
                                                    </div>

                                                    <div class="d-inline">
                                                        <form class="d-inline" name="delete-template" action="#" method="POST">
                                                            @csrf
                                                            @method("DELETE")

                                                            <input name="template" type="hidden" value="{{ $template['name'] }}">

                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
@endsection