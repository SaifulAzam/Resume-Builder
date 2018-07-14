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
                                form_method="{{ $form_method }}"
                                name="{{ $title }}"
                                template="{{ $template }}"
                                user="{{ $user }}"></resume-form-component>
                    @else
                        <resume-form-component
                                author="{{ $author }}"
                                form_action_url="{{ $form_action_url }}"
                                form_method="{{ $form_method }}"
                                name="{{ $title }}"
                                template="{{ $template }}"
                                user="{{ $user }}"></resume-form-component>
                    @endif
                </div>

                <div class="col-md">
                    @include('partials._resume-action-card')
                </div>
            </div>
        </div>

        <resume-add-section-modal-component></resume-add-section-modal-component>
        <resume-preview-modal-component></resume-preview-modal-component>
        <resume-select-template-modal-component></resume-select-template-modal-component>
    </section>
@endsection
