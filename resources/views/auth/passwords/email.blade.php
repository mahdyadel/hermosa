@extends('layouts.auth')
@section('title', __('messages.reset_password') )

@section('content')
<div class="m-login__signin">
    
    <div class="m-login__head">
        <h3 class="m-login__title">{{ __('messages.admin_panel') }}</h3>
        <div class="m-login__desc">{{ __('messages.forget_password_desc') }}</div>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form class="m-login__form m-form" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} m-form__group">
            <input class="form-control m-input" type="text" placeholder="{{ __('messages.email') }}" name="email" value="{{ old('email') }}" autocomplete="off" required autofocus="">
            @if ($errors->has('email'))
                <div id="email-error" class="form-control-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="m-login__form-action">
            <button type="submit" class="btn btn-brand">{{ __('messages.reset_password') }}</button>
        </div>

    </form>

</div>
@endsection
