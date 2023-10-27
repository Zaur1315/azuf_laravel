@include('partials.header')
{{--@extends('layouts.app')--}}
<main >
    <div class="container">
        <h1 class="heading">{{__('messages.login-page',[], session('locale'))}}</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form">
                        <div class="form_col w-100">
                            <label class="input_lab" for="email">{{__('messages.email', [], session('locale'))}}</label>
                            <input type="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" name="email" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form">
                        <div class="form_col w-100">
                            <label class="input_lab" for="password">{{__('messages.password', [], session('locale'))}}</label>
                            <input type="password" class="@error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                        </div>
                    </div>
                    <div class="form-check text-center">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{__('messages.remember',[], session('locale'))}}
                        </label>
                    </div>
                    <div class="form_row">
                        <div class="form_col w-100">
                            <input class="submit" type="submit" value="{{__('messages.login',[], session('locale'))}}" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@include('partials.footer')
