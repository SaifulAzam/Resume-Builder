@extends('app')

@section('app_content')
    <section class="resume-new">
        <resume-form-component form_action_url="{{ $form_action_url }}"></resume-form-component>
    </section>
@endsection
