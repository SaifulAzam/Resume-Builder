@extends('app')

@section('app_content')
    <section class="resume-new">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-9">
                    <resume-form-component form_action_url="{{ $form_action_url }}"></resume-form-component>
                </div>

                <div class="col-md">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            {{--  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
