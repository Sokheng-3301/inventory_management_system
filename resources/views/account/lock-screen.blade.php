<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.meta')
    <title>{{ __('nav.lockScreen') }} | IMS</title>

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

        body {
            background-color: #d2d6de;
            width: 100%;
            height: 100%;
            position: fixed;
            overflow: hidden;
            text-align: center;
        }

        .lock_screen_content {
            border-radius: 4px;
            padding: 0;
            background: #ffffff;
            position: relative;
            margin: 10px auto 30px auto;
            width: 300px;
        }

        .lock_screen_item {
            border-radius: 50%;
            position: absolute;
            left: -10px;
            top: -25px;
            background: #fff;
            padding: 5px;
            z-index: 10;
        }

        .lock_screen_item>img {
            border-radius: 50%;
            width: 70px;
            height: 70px;
        }

        form {
            margin-left: 45px
        }

        form input {
            padding-left: 33px !important;
        }

        #submit {
            cursor: pointer !important;
        }
        .time{
            margin-top: 60px;
            font-size: 55px;
            margin-bottom: 50px;
            color: #414141;
            width: fit-content;
            text-align: start;
            margin-inline: auto
        }
    </style>
</head>

<body>
    <div class="time">
        <p class="mb-4">
            {{ now()->format('l, j F Y') }}
        </p>
        <div class="clock" id="clock"></div>
    </div>
    <img src="{{ asset('images/Hi-Tech Water Logo (ENG)-01.png') }}" alt="" width="170">

    <h1 class="ui header medium">
        {{ Auth::user()->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }}
        {{ session('localization') == 'kh' ? strtoupper(Auth::user()->name_kh) : strtoupper(Auth::user()->name_en) }}
    </h1>


    <div class="lock_screen_content mt-5">
        <div class="lock_screen_item">
            <img src="{{ @Auth::user()->profile ? asset(@Auth::user()->profile) : asset('images/draft-user.jpg') }}"
                alt="profile" />
        </div>
        <form action="{{ route('screen.unlock') }}" method="POST" class="ui form" autocomplete="off"
            id="formUnlockScreen">
            @csrf
            <div class="ui icon input w-100" id="labelInput">
                <input type="password" class="w-100" name="password" id="password"
                    placeholder="{{ __('nav.password') }}" required>
                <i class="inverted blue circular arrow right link icon" id="submit"></i>
            </div>
        </form>
    </div>
    @session('password')
        <p class="text-danger p-0 m-0">{{ session('password') ? session('password') : '' }}</p>
    @endsession
    <h5 class="ui header fw-normal ">{{ config('app.name') }}</h5>
    <a href="{{ route('logout') }}"><i class="ui logout icon"></i>{{ __('nav.logout') }}</a>



    @include('layout.script')

    <script>
        $(document).ready(function() {
            $(document).on('click', '#submit', function() {
                if ($('#password').val() === '') {
                    $('#labelInput').addClass('error');
                } else {
                    $('#formUnlockScreen').submit();
                }
            });

            // digital clock
            function updateClock() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                $('#clock').text(`${hours}:${minutes}:${seconds} {{ now()->format('A') }}`);
            }

            setInterval(updateClock, 1000);
            updateClock(); // Initial call to display the clock immediately
        });
    </script>
</body>

</html>
