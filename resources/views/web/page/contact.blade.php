@extends(env('WEBSITE_TEMPLATE') . '._base.layout')

@section('title', __('general.contact'))

@section('css')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .form-control {
            border-radius: 10px;
        }

        .card-body {
            color: #788BFF;
        }

        #sub {
            background: #788BFF;
            border-radius: 30px;
            font-size: 1.5rem;
        }

        .contact {
            padding: 4rem 1rem 0 1rem;
        }
    </style>
@stop

<?php
$homepage = $page['contact'] ?? [];
?>

@section('content')
    <div class="contact row">
        <div class="col-md-6">
            <div class="card-body">
                <h1 class="text-center text-bold">Contact Us</h1>
                {{ Form::open(['route' => ['contact'], 'files' => true, 'id'=>'form', 'role' => 'form'])  }}
                    @captcha
                    <div class="form-outline mb-3">
                        <label for="name">{{ __("general.name") }} <span class="text-red">*</span></label>
                        {{ Form::text("name", old("name"), ['id' => 'name', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}
                        @if($errors->has("name")) <div class="invalid-feedback">{{ $errors->first("name") }}</div> @endif
                    </div>

                    <div class="form-outline mb-3">
                        <label for="email">{{ __("general.email") }} <span class="text-red">*</span></label>
                        {{ Form::email("email", old("email"), ['id' => 'email', 'class' => $errors->has('email') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}
                        @if($errors->has("email")) <div class="invalid-feedback">{{ $errors->first("email") }}</div> @endif
                    </div>

                    <div class="form-outline mb-3">
                        <label for="phone">{{ __("general.phone") }}</label>
                        {{ Form::text("phone", old("phone"), ['id' => 'phone', 'class' => $errors->has('phone') ? 'form-control is-invalid' : 'form-control', 'required' => false]) }}
                        @if($errors->has("phone")) <div class="invalid-feedback">{{ $errors->first("phone") }}</div> @endif
                    </div>

                    <div class="form-outline mb-3">
                        <label for="subject">{{ __("general.subject") }} <span class="text-red">*</span></label>
                        {{ Form::text("subject", old("subject"), ['id' => 'subject', 'class' => $errors->has('subject') ? 'form-control is-invalid' : 'form-control', 'required' => true]) }}
                        @if($errors->has("subject")) <div class="invalid-feedback">{{ $errors->first("subject") }}</div> @endif
                    </div>
                    <div class="form-outline mb-3">
                        <label for="message">{{ __("general.message") }} <span class="text-red">*</span></label>
                        {{ Form::textarea("message", old("message"), ['id' => 'subject', 'class' => $errors->has('message') ? 'form-control is-invalid' : 'form-control', 'required' => true, 'rows' => 3]) }}
                        @if($errors->has("message")) <div class="invalid-feedback">{{ $errors->first("message") }}</div> @endif
                    </div>

                    <button type="submit" class="btn btn-block text-white" id="sub" title="@lang('general.send')">
                        <span class="text-bold"> @lang('general.send')</span> <i class="fa fa-arrow-right"></i>
                    </button>

                {{ Form::close() }}
            </div>
        </div>
        <div class="col-md-6 d-flex align-self-center justify-content-center">
            <img src="{{ isset($homepage['image']) ? asset($homepage['image']) : asset('assets/cms/images/no-img.png') }}"
                class="img-responsive img-fluid w-75" alt="Contact Logo" />
        </div>
    </div>
@stop

@section('script-bottom')
    @parent
@stop
