@php
    // dd(Auth::user());
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.meta')
    <title>{{ __('nav.login') }} | IMS</title>

    <style>
        @font-face {
            font-family: 'Akbalthom Naga';
            src: url({{ asset('fonts/AKbalthom-Naga.ttf') }});
        }

        @font-face {
            font-family: 'Poppins';
            src: url({{ asset('fonts/Poppins-Regular.ttf') }});
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        label,
        span,
        ul,
        li,
        a,
        input,
        textarea,
        select,
        small,
        div,
        section,
        select,
        table,
        th,
        td,
        button {
            font-family: 'Poppins', 'Akbalthom Naga', sans-serif !important;
        }

        #backgroundLogin {
            width: 100%;
            height: 100%;
            position: fixed;
            background: #ffffff;

        }

        .bg-img {
            height: 100%;
            position: absolute;
            background-image: url("{{ asset('images/login-bg.jpg') }}");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .bg-img-login {
            height: 100%;
            background-image: url("{{ asset('images/boxed-bg.png') }}");
            position: absolute;
            right: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .row {
            margin: unset !important;
        }
    </style>
</head>

<body>
    <div id="backgroundLogin">
        <div class="row">
            <div class="col-md-7 bg-img"></div>
            <div class="col-md-5 bg-img-login">
                <div class="col-10 col-md-9 col-lg-9">
                    <img src="{{ asset('images/Hi-Tech Water Logo (ENG)-01.png') }}" class="ui image small mx-auto"
                        alt="Logo">
                    <h3 class="ui header medium text-primary">{{__("nav.signinNow")}}</h3>

                    <form class="ui form" method="POST" autocomplete="off" action="{{ route('login.save') }}">
                        @csrf
                        @error('email')
                            <div class="ui red message">{{ __('nav.invalidLogin') }}</div>
                        @enderror

                        <div class="field">
                            <label for="username">{{ __('nav.username') }}</label>
                            <div class="ui left icon input">
                                <input type="text" class="d-block w-100" id="username" autofocus
                                    placeholder="{{ __('nav.username') }}" name="email" value="{{ old('email') }}">
                                <i class="user icon"></i>
                            </div>
                        </div>

                        <div class="field">
                            <label for="password">{{ __('nav.password') }}</label>
                            <div class="ui left icon input">
                                <input type="password" id="password" class="d-block w-100 " id="password"
                                    placeholder="{{ __('nav.password') }}" name="password">
                                <i class="lock icon"></i>
                            </div>
                        </div>

                        <div class="field">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input" id="eyeBtn">
                                        {{ __('nav.showPass') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <button type="submit" class="ui button medium blue d-block w-100 font-weight-medium auth-form-btn">
                                <i class="icon sign-in"></i>
                                {{ __('nav.signinBtn') }}
                            </button>
                        </div>
                        <div class="text-center mt-5">
                            <p class="text-muted text-center">{{ config('app.name') }} </p>
                            <p class="text-muted text-center">{{ config('app.version') }} </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layout.script')

        <script>
            const togglePassword = document.getElementById('eyeBtn');
            const passwordInput = document.getElementById('password');
            const eye = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'password') {
                    eye.classList.remove('mdi-eye-outline')
                    eye.classList.add('mdi-eye-off-outline')
                } else {
                    eye.classList.remove('mdi-eye-off-outline')
                    eye.classList.add('mdi-eye-outline')
                }
            });
            $('.ui.form')
                .form({
                    fields: {
                        email: {
                            identifier: 'email',
                            rules: [{
                                type: 'empty',
                                prompt: 'Please enter email'
                            }]
                        },
                        password: {
                            identifier: 'password',
                            rules: [{
                                type: 'empty',
                                prompt: 'Please enter a password'
                            }]
                        },
                    }
                });
        </script>
</body>

</html>
