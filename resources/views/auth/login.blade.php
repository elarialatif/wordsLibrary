@extends('layouts.head')
@section ('css')
<link href="{{ asset('public/css/feather.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/fontawesome-all.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/layouts/login.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('public/fonts/material/css/materialdesignicons.min.css')}}">

@endsection



    <div class="login_page">
        <div class="auth-wrapper">
            <div class="auth-content">
                <div class="card login_card">
                    <div class="card-body text-center" >
                        <div class="mb-4">
                            <i class="feather icon-unlock auth-icon"></i>
                        </div>
                        <h3 class="mb-4">تسجيل الدخول</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="الحساب الإلكتروني">
                            </div>

                            <div class="input-group mb-4">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="كلمة السر ">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group text-left">
                                <div class="checkbox checkbox-fill d-inline">
                                    <input type="checkbox"  name="remember" id="checkbox-fill-a1" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="checkbox-fill-a1" class="cr">حفظ البيانات</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary shadow-2 mb-4">تسجيل الدخول</button>

                            <a  href="{{ route('password.request') }}">
                                <p class="mb-2 text-muted">هل نسيت كلمة السر؟ </p>
                            </a>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
    </div>