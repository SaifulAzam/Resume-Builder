@extends('app')

@section('app_content')
    <section class="resume-new">
        <div class="container">
            @if ($errors->any())
            <div class="row justify-content-center">
                <div class="col-md-6 mt-4">
                    <div class="alert alert-danger mb-0">
                        <ul class="mb-0">
                            <li>{{ $errors->first() }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <div class="row my-4">
                <div class="col-md-9">
                    @if (isset($data))
                    <resume-form-component
                            author="{{ $author }}"
                            data="{{ $data }}"
                            form_action_url="{{ $form_action_url }}"
                            name="{{ $title }}"
                            template="{{ $template }}"></resume-form-component>
                    @else
                    <resume-form-component
                            author="{{ $author }}"
                            form_action_url="{{ $form_action_url }}"
                            name="{{ $title }}"
                            template="{{ $template }}"></resume-form-component>
                    @endif
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

        <resume-add-section-modal-component></resume-add-section-modal-component>
    </section>
@endsection
