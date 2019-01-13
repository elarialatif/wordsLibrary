@include('layouts.head')


<link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/feather.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/fontawesome-all.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/layouts/login.css') }}" rel="stylesheet">

<div class="login_page">
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-mail auth-icon"></i>
                    </div>
                    <h3 class="mb-4">إعادة تعيين كلمة السر </h3>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="البريد الإلكتروني">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary mb-4 shadow-2"> إعادة تعيين كلمة السر</button>
                    </form>         

                </div>
            </div>
        </div>
    </div>
</div>