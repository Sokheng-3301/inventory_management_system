<!DOCTYPE html>
<html lang="{{ session('localization') ?? 'en' }}">

<head>

    @include('layout.meta')
    @yield('link')
    @yield('title')

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

        .back-btn {
            padding: 5px 15px !important;
        }

        .back-btn:hover {
            background-color: unset !important;
            color: rgb(235, 0, 0);
            border: 1px solid rgb(235, 0, 0);
        }

        

        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .navbar-dropdown {
            padding: 0;
        }

        #welcome {
            width: 100%;
            height: 100%;
            position: fixed;
            background: #4069a3;
            z-index: 9999999 !important;
        }

        #welcome img.logo-hitech {
            width: 20%;
            height: auto;
            position: relative;
            top: 40%;
            left: 41%;
            transform: translate(-50%, -25%);
            animation: scaleUp 8s infinite;
        }

        @keyframes scaleUp {
            0% {
                transform: scale(0.6);
                /* Original size */
            }

            50% {
                transform: scale(2.1);
            }

            100% {
                transform: scale(1.7);
                /* Back to original size */
            }
        }

        #sidebar {
            background: #373b40;
            color: #b9bdc7;
        }

        .navbar {
            /* box-shadow: none !important; */
            box-shadow: #a1a1a1 0px 1px 10px -5px !important;
            /* border-bottom: 1px solid #ffffff23 !important; */
        }

        #sidebar .nav-item {
            color: #ced4da !important;
            /* background: red !important; */
        }

        #sidebar .nav-item .nav-link {
            color: #ced4da !important;
        }

        #sidebar .nav-item .nav-link .menu-icon {
            color: #ced4da !important;
        }

        #sidebar .nav-item .nav-link:hover {
            backgroud: #ffffff1a !important;
            color: #ffff !important;
        }

        #sidebar .nav-item.active .nav-link {
            background: #ffffffe6 !important;
        }

        #sidebar .nav-item.active .nav-link .menu-icon,
        #sidebar .nav-item.active .nav-link .menu-title,
        #sidebar .nav-item.active .nav-link .menu-arrow {
            color: #343a40 !important;

        }

        #sidebar .nav-item:hover .nav-link {
            background: #4b4f54 !important;
        }

        #sidebar .nav-item.active:hover .nav-link {
            background: #ffffffe6 !important;
        }

        #sidebar .nav.sub-menu {
            background: #4b4f54 !important;

        }

        #sidebar .nav-item.active .sub-menu .nav-link {
            background: unset !important;
        }

        .sidebar .nav:not(.sub-menu)>.nav-item.active {
            background: unset !important;

        }

        .navbar-brand-wrapper {
            background: #373b40 !important;
        }

        @media only screen and (max-width: 991px) {
            .navbar-brand-wrapper {
                background: #ffffff !important;
            }
        }

        /* //window loader  */
        #window_preloader {
            width: 100%;
            height: 100%;
            position: fixed;
            background: #ffffff51;
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader {
            transform: rotateZ(45deg);
            perspective: 1000px;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            color: #FBC02D;
        }

        .loader:before,
        .loader:after {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            width: inherit;
            height: inherit;
            border-radius: 50%;
            transform: rotateX(70deg);
            animation: 1s spin linear infinite;
        }

        .loader:after {
            color: #D32F2F;
            transform: rotateY(70deg);
            animation-delay: .4s;
        }

        @keyframes rotate {
            0% {
                transform: translate(-50%, -50%) rotateZ(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotateZ(360deg);
            }
        }

        @keyframes rotateccw {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(-360deg);
            }
        }

        @keyframes spin {

            0%,
            100% {
                box-shadow: .4em 0px 0 0px currentcolor;
            }

            12% {
                box-shadow: .4em .4em 0 0 currentcolor;
            }

            25% {
                box-shadow: 0 .4em 0 0px currentcolor;
            }

            37% {
                box-shadow: -.4em .4em 0 0 currentcolor;
            }

            50% {
                box-shadow: -.4em 0 0 0 currentcolor;
            }

            62% {
                box-shadow: -.4em -.4em 0 0 currentcolor;
            }

            75% {
                box-shadow: 0px -.4em 0 0 currentcolor;
            }

            87% {
                box-shadow: .4em -.4em 0 0 currentcolor;
            }
        }

        /* window loader end  */

        /* download preload  */
        #downloadPreload {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            display: none;
            justify-content: center;
            align-items: center;
            background: #f3f3f3;
            z-index: 501110;
        }

        .loaderDownload {
            display: block;
            position: relative;
            height: 22px;
            width: 300px;
            border: 1px solid #808080;
            border-radius: 100px;
            overflow: hidden;
            text-align: center;
            font-weight: bold;
            margin: 0;
            padding: 0;
            color: #4d4d4d;
            font-size: small;
        }

        .loaderDownload:after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: #02b482f3;
            animation: 3.5s prog ease-in infinite;
        }

        @keyframes prog {
            to {
                width: 100%;
            }
        }


        /* download preload  */
    </style>

    @yield('css')

</head>

<body>


    {{-- @if (!session('success') && !session('error') && !session('confirmSubmit'))
        <div id="window_preloader">
            <div class="loader"></div>
        </div>
    @endif --}}
    <div id="downloadPreload">
        <span class="loaderDownload" id="downloadBar">
            {{ __('nav.Downloading') }}...
        </span>
    </div>

    @php
        $checkRole = DB::table('user_roles')
            ->where('id', @Auth::user()->role_id)
            ->get()
            ->first();

    @endphp
    @session('logedin')
        <!-- Google Chrome -->
        <div id="preLoaderWelcome">
            <div class="infinityChrome">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <!-- Safari and others -->
            <div class="infinity">
                <div>
                    <span></span>
                </div>
                <div>
                    <span></span>
                </div>
                <div>
                    <span></span>
                </div>
            </div>

            <!-- Stuff -->
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display: none;">
                <defs>
                    <filter id="goo">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7"
                            result="goo" />
                        <feBlend in="SourceGraphic" in2="goo" />
                    </filter>
                </defs>
            </svg>
        </div>
    @endsession





    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/"><img
                        src="{{ asset('images/Hi-Tech Water Logo (ENG).png') }}" id="logo_image" class="mr-2"
                        alt="logo" /></a>
                {{-- <a class="navbar-brand brand-logo mr-5" href="/"><img src="{{asset('images/Hi-Tech-favicon.png')}}" alt="logo" /></a> --}}
                <a class="navbar-brand brand-logo-mini" href="/"><img
                        src="{{ asset('images/Hi-Tech-favicon.png') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <a class="navbar-toggler navbar-toggler align-self-center" type="button" id="navBarButton"
                    data-toggle="minimize">
                    {{-- <i class="ui bars icon"></i> --}}
                    <span class="mdi mdi-menu fs-3"></span>
                </a>
                <ul class="navbar-nav navbar-nav-right">
                    {{-- @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $checkRole->role_name == 'Super Admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-toggle="dropdown" title="Notification requests">
                                <i class="icon-bell mx-0"></i>
                                @php
                                    $checkNotification = DB::table('borrows')
                                        ->where('borrows.notification', 1)
                                        ->exists();
                                @endphp
                                @if ($checkNotification == true)
                                    <span class="count"></span>
                                @endif
                            </a>
                            @if ($checkNotification == true)
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                    aria-labelledby="notificationDropdown">
                                    <p class="mb-0 font-weight-normal float-left dropdown-header">
                                        {{ __('nav.notification') }}</p>
                                    @php
                                        $notification = DB::table('borrows')
                                            ->where('borrows.notification', 1)
                                            ->join('users', 'borrows.staff_id', '=', 'users.card_id')
                                            ->orderBy('borrows.borrow_id', 'desc')
                                            ->orderBy('borrows.borrow_date', 'desc')
                                            ->get()
                                            ->take(5);
                                    @endphp
                                    @foreach ($notification as $n)
                                        <a class="dropdown-item preview-item" href="{{ route('request.index') }}">
                                            <div class="preview-thumbnail">
                                                <div class="preview-icon bg-success">
                                                    @if ($n->profile != '')
                                                        <img src="{{ asset($n->profile) }}" width="100%"
                                                            alt="user profile">
                                                    @else
                                                        <img src="{{ asset('images/draft-user.jpg') }}" width="100%"
                                                            alt="user profile">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="preview-item-content">
                                                <h6 class="preview-subject font-weight-normal">
                                                    @if (session('localization') == 'en')
                                                        {{ $n->name_en }}
                                                    @else
                                                        {{ $n->name_kh }}
                                                    @endif
                                                </h6>
                                                <p class="font-weight-light small-text mb-0 text-muted">
                                                    {{ $n->borrow_date }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                    @php
                                        session()->forget('notificationDropdown');
                                    @endphp
                                </div>
                            @endif

                        </li>
                    @endif --}}

                    <li class="nav-item dropdown">
                        <a type="button" class="d-flex align-items-center" data-toggle="dropdown"
                            id="language">
                            {{-- <span class="mdi mdi-web fs-5 text-primary pe-1"></span>  --}}
                            @if (session('localization') == 'kh')
                                <img src="{{ asset('images/khmer-language.png') }}" alt="Khmer" class="pe-2"> {{ __("nav.khmer") }}
                                <span class="mdi mdi-menu-down fs-6"></span>
                            @else
                                <img src="{{ asset('images/english-language.png') }}" alt="English" class="pe-2"> {{ __('nav.english') }}
                                <span class="mdi mdi-menu-down fs-6"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="language" id="languageDropdown">

                            <a class="dropdown-item" href="{{ route('localization', 'kh') }}">
                                <img src="{{ asset('images/khmer-language.png') }}" alt="Khmer">
                                <span class="d-inline-block ps-2">{{ __('nav.khmer') }}</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('localization', 'en') }}">
                                <img src="{{ asset('images/english-language.png') }}" alt="English">
                                <span class="d-inline-block ps-2">{{ __('nav.english') }}</span>
                            </a>

                        </div>
                    </li>

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <img src="{{@Auth::user()->profile ? asset(@Auth::user()->profile) : asset('images/draft-user.jpg') }}" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown overflow-hidden" id="userProfileDropdown"
                            aria-labelledby="profileDropdown">

                            <div class="bg_profile">
                                <img src="{{@Auth::user()->profile ? asset(@Auth::user()->profile) : asset('images/draft-user.jpg') }}" alt="profile" class="label_img"/>
                                <p>
                                    {{ Auth::user()->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }} {{ session('localization') == 'kh' ? strtoupper(Auth::user()->name_kh) : strtoupper(Auth::user()->name_en) }}
                                    ({{ $checkRole->role_name }})
                                </p>
                                <p>
                                    {{ __('nav.staffId') }}: {{ Auth::user()->card_id }}
                                </p>

                                <hr class="my-3 border-white">
                                <p>{{ __("nav.loginDate") . ' : '. Carbon\Carbon::parse(Auth::user()->login_date)->format('d M Y') }}</p>
                                <p>{{ __("nav.loginTime") . ' : '. Carbon\Carbon::parse(Auth::user()->login_date)->format('h:i:s A') }}</p>
                            </div>


                            <a class="dropdown-item" href="{{ route('account.profile') }}">
                                {{-- <span class="mdi mdi-account text-primary"></span> --}}
                                <i class="ti-user text-primary"></i>
                                {{ __('nav.profile') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('account.change-password') }}">
                                {{-- <span class="mdi mdi-account text-primary"></span> --}}
                                <i class="ti-unlock text-primary"></i>
                                {{ __('nav.changePassword') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('screen.setLocked') }}">
                                {{-- <span class="mdi mdi-account text-primary"></span> --}}
                                <i class="ti-key text-primary"></i>
                                {{ __('nav.lockScreen') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="ti-power-off text-primary"></i>
                                {{ __('nav.logout') }}
                            </a>
                        </div>
                    </li>
                </ul>

                <a class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas" id="sidebarBtnRight">
                    {{-- <i class="ui bars icon"></i> --}}
                    <span class="mdi mdi-menu fs-3"></span>
                </a>
            </div>

            @if (@session('flashNotification') == '1')

                @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $checkRole->role_name == 'Super Admin')
                    {{-- <div class="row">
                    <div class="col-11 col-sm-10 col-md-4 col-lg-4" id="NotificationAlertFlash">
                        <div class="dropdown-menu-right navbar-dropdown preview-list">
                            @foreach ($notifications as $notification)
                                <div class="dropdown-item preview-item d-flex align-items-center py-2   ">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                                @if ($notification->profile != '')
                                                    <img src="{{asset($notification -> profile)}}" width="100%" alt="user profile">
                                                @else
                                                    <img src="{{asset('images/draft-user.jpg')}}" width="100%" alt="user profile">
                                                @endif
                                        </div>
                                    </div>

                                    <div class="preview-item-content d-flex align-items-center justify-content-between w-100">
                                        <h6 class="preview-subject font-weight-normal" style="width: fit-content; margin: 0;">
                                            <span class="fw-bold">
                                                @if (session('localization') == 'kh')
                                                    {{$notification -> name_kh}}
                                                @else
                                                    {{$notification -> name_en}}
                                                @endif
                                            </span> <br> <small>

                                            @if (session('localization') == 'kh')
                                                    {{$notification -> pro_name_kh}}
                                                @else
                                                    {{$notification -> pro_name_en}}
                                                @endif

                                                <span class="text-danger ps-3"> x {{$notification->borrow_qty}}</span></small>
                                        </h6>
                                        <p class="font-weight-light small-text mb-0 text-muted" style="width: fit-content;">
                                            {{$notification->request_datetime}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div> --}}
                @endif
            @endif
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            {{-- ---sidebar here start ---  --}}
            <nav class="sidebar sidebar-offcanvas" id="sidebar">

                {{-- @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $checkRole->role_name == 'Super-Admin') --}}
                @include('layout.sidebar')
                {{-- @else --}}
                {{-- ------  Sidebar without ADmin ------- --}}
                {{-- <ul class="nav" id="sidebar-menu">
                            @php
                                $currentUrl = Route::current()->uri();
                                $functionsQry = DB::table('apply_funcion_for_role')
                                    ->where('role_id', @Auth::user()->role_id)
                                    ->get()
                                    ->first();
                                $mainFunction = $functionsQry->main_function_id;
                                $subFunction = $functionsQry->sub_function_id;

                                $exMainFunction = explode(',', $mainFunction);

                                $exSubFunction = explode(',', $subFunction);
                            @endphp

                            @foreach ($exMainFunction as $em)
                                @php
                                    $function = DB::table('main_function')->where('id', $em)->get();
                                @endphp
                                @foreach ($function as $f)
                                    @if ($f->name == 'Dashboard')
                                        <li class="nav-item" id="home">
                                            <a class="nav-link" href="/">
                                                <i class="mdi mdi-home menu-icon"></i>
                                                <span class="menu-title">{{ __('nav.dashboard') }}</span>
                                            </a>
                                        </li>
                                    @elseif ($f->name == 'Reports')
                                        <li class="nav-item" id="inventory_list">
                                            <a class="nav-link" href="{{ route('reports.index') }}">
                                                <i class="mdi mdi-chart-bar menu-icon"></i>
                                                <span class="menu-title">{{ __('nav.report') }}</span>
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item" id="master{{ $f->id }}">
                                            <a class="nav-link" data-toggle="collapse"
                                                href="#ui-basic{{ $f->id }}" aria-expanded="false"
                                                aria-controls="ui-basic{{ $f->id }}">
                                                <i class="mdi {{ $f->icon_name }} menu-icon"></i>
                                                <span class="menu-title">
                                                    @if (session('localization') == 'en')
                                                        {{ $f->name }}
                                                    @else
                                                        {{ $f->name_kh }}
                                                    @endif
                                                </span>
                                                <i class="menu-arrow"></i>
                                            </a>
                                            @foreach ($exSubFunction as $sub)
                                                @php
                                                    $subFunctionoQry = DB::table('sub_function')
                                                        ->where('main_function_id', $f->id)
                                                        ->where('id', $sub)
                                                        ->get();
                                                @endphp
                                                @foreach ($subFunctionoQry as $subData)
                                                    @if ($f->name == 'Manage Users')
                                                        <div class="collapse" id="ui-basic{{ $f->id }}">
                                                            <ul class="nav flex-column sub-menu">
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="{{ url($subData->route_name) }}">
                                                                        {{ $subData->name }}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @else
                                                        <div class="collapse" id="ui-basic{{ $f->id }}">
                                                            <ul class="nav flex-column sub-menu">
                                                                <li class="nav-item">
                                                                    <a class="nav-link"
                                                                        href="{{ route($subData->route_name) }}">
                                                                        @if (session('localization') == 'en')
                                                                            {{ $subData->name }}
                                                                        @else
                                                                            {{ $subData->name_kh }}
                                                                        @endif
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach
                        </ul> --}}
                {{-- ------  Sidebar without ADmin ------- --}}
                {{-- @endif --}}
            </nav>
            {{-- ---sidebar here end ---  --}}

            <div class="main-panel">
                @yield('content')
                <!-- partial:partials/_footer.html -->
                <div id="scrollTopButton">
                    <span class="mdi mdi-chevron-up"></span>
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            Developed by: IT Department <a>SL-Hitech</a> 2025 - {{ now()->format('Y') }}
                        </span>
                        <span
                            class="text-muted text-center text-sm-left d-block d-sm-inline-block">{{ config('app.version') }}</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>






    <!-- Modal backup data -->
    <div class="modal fade" id="dataBackupForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="dataBackupFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="dataBackupFormLabel"> {{ __('nav.exportDatatoSql') }} </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h2 class="ui icon header">
                        <i class="upload icon"></i>
                        <div class="content">
                            {{ __('nav.exportData') }}
                            <div class="sub header"> {{ __('nav.exportDataQuestion') }} </div>
                        </div>
                    </h2>
                </div>
                <div class="modal-footer">
                    <div class="ui buttons">
                        <button class="ui button" type="button" class="ui button mini grey "
                            data-bs-dismiss="modal"> {{ __('nav.cancel') }} </button>
                        <div class="or"></div>
                        <form action="{{ route('database.export') }}" method="post">
                            @csrf
                            <button type="submit" class="ui blue button"> {{ __('nav.yesExport') }} </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>






    @include('layout.script')
    <script type="text/javaScript">
        $(document).ready(function() {
            $('body').scroll(function() {
                // alert('Hello Scrolling');
                if ($(this).scrollTop() > 200) {
                    $('#scrollTopButton').css('display', 'flex');
                    $('#scrollTopButton').fadeIn();
                } else {
                    $('#scrollTopButton').css('display', 'none');
                    $('#scrollTopButton').fadeOut();
                }
            });
            // On click, scroll to top
            $('#scrollTopButton').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
            });


            // $(document).on('click', '#printButton', function() {window.print();});


             // $(document).on('click', '#printButton', function() {window.print();});

                    $(document).on('click', '#printButton', function() {
                        // alert("Hello printer");
                        var content = $('.table-responsive').html();
                        var myWindow = window.open('', '', 'width=800,height=500');
                        myWindow.document.write(`
                        <html><head>
                            <title>Print Invoice</title>
                            @include('layout.meta')
                            <style>
                                @font-face {
                                    font-family: 'Akbaltom Nagar';
                                    src: url('/fonts/AKbalthom-Naga.ttf') format('truetype');
                                    font-weight: normal;
                                }
                                @font-face {
                                    font-family: 'Poppins';
                                    src: url('/fonts/Poppins-Regular.ttf') format('truetype');
                                    font-weight: normal;
                                }
                                * {
                                    font-family: 'Poppins', 'Lato', 'Helvetica Neue', 'Akbaltom Nagar', sans-serif !important;
                                }
                                body{
                                    margin: 15px !important;
                                }
                            </style>
                        `);
                        myWindow.document.write('</head><body>');
                        myWindow.document.write(content);
                        myWindow.document.write('</body></html>');
                        myWindow.document.close();
                        myWindow.print();

                    });


        });

                    $(window).on('load', function() {
                        $('#preLoaderWelcome').addClass('fade-out');
                        setTimeout(function() {
                            $('#preLoaderWelcome').hide();
                            $('#content').fadeIn('slow');
                        }, 1500); // Match the timeout to the CSS transition duration
                    });

                    $(document).ready(function() {
                        $('#myTable').DataTable({
                            "language": {
                                "search": "{{ __('nav.search') }}",
                                "lengthMenu": "{{ __('nav.show') }} _MENU_ {{ __('nav.records') }}",
                                "info": "{{ __('nav.showing') }} _START_ {{ __('nav.to') }} _END_ {{ __('nav.of') }} _TOTAL_ {{ __('nav.records') }}",
                                "infoEmpty": "{{ __('nav.noRecordsFound') }}",
                                "paginate": {
                                    "next": "{{ __('nav.next') }}",
                                    "previous": "{{ __('nav.previous') }}"
                                }
                            },
                            "lengthMenu": [
                                [20, 35, 50, -1],
                                [20, 35, 50, "{{ __('nav.all') }}"]
                            ],
                        });

                        $('#myTable1').DataTable({
                            "language": {
                                "search": "{{ __('nav.search') }}",
                                "lengthMenu": "{{ __('nav.show') }} _MENU_ {{ __('nav.records') }}",
                                "info": "{{ __('nav.showing') }} _START_ {{ __('nav.to') }} _END_ {{ __('nav.of') }} _TOTAL_ {{ __('nav.records') }}",
                                "infoEmpty": "{{ __('nav.noRecordsFound') }}",
                                "paginate": {
                                    "next": "{{ __('nav.next') }}",
                                    "previous": "{{ __('nav.previous') }}"
                                }
                            },
                            "lengthMenu": [
                                [20, 35, 50, -1],
                                [20, 35, 50, "{{ __('nav.all') }}"]
                            ],
                        });
                    });

                    var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

                    if (!isChrome) {
                        document.getElementsByClassName('infinityChrome')[0].style.display = "none";
                        document.getElementsByClassName('infinity')[0].style.display = "block";
                    }
                </script>
    {{--
    @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $checkRole->role_name == 'Super Admin')
        <script src="{{ asset('pusher/pusher.min.js') }}"></script>
        <script>
            Pusher.logToConsole = true;
            var pusher = new Pusher('8beb1a83beb5f72ce3eb', {
                cluster: 'ap1'
            });
            var channel = pusher.subscribe('popup-channel');
            channel.bind('user-request', function(data) {
                toastr["info"](JSON.stringify('A user has borrow\'s requested'));
            });
        </script>
    @endif --}}
    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: "Congratulation",
                    text: "{{ session('success') }}",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: "Something have wrong",
                    text: "{{ session('error') }}",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // delete button
            $(document).on('click', '#deleteButton', function() {
                var id = $(this).data('id');
                $('#deleteVerify').modal('show');
                $('#deleteProID').val(id);
            });
            //restore
            $(document).on('click', '#restoreButton', function() {
                var id = $(this).data('id');
                $('#restoreModal').modal('show');
                $('#restoreProID').val(id);
            });
            @if (!session('success') && !session('error') && !session('confirmSubmit'))
                $(window).on('load', function() {
                    var duration = 1500; // 2 seconds
                    var fadeDuration = 800;
                    $('.container-scroller').fadeOut(fadeDuration);
                    setTimeout(function() {
                        $('#window_preloader').addClass('d-none');
                    }, duration);
                    $('.container-scroller').fadeIn(fadeDuration);
                });
            @endif


            $('[title="Excel"], [title="PDF"]').on('click', function() {
                $('#downloadPreload').css('display', 'flex');
                setTimeout(function() {
                    $('#downloadPreload').css('display', 'none');
                    // ----------- success message -----------
                    Swal.fire({
                        title: "Congratulation",
                        text: "Download report has successfully.",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                }, 3500);
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            // nav bar
            // $(document).on('click', '#navBarButton', function() {
            //     var navBar = $('#sidebar');
            //     if (navBar.css('width') === '235px') {
            //         navBar.css('width', '75px'); // Hide the sidebar
            //         $('.navbar-brand-wrapper').css('width', '75px'); // Adjust brand logo width
            //         $('#logo_image').attr('src', "{{ asset('images/Hi-Tech-favicon.png') }}");
            //         $('#logo_image').css('marginLeft', '20px');
            //         $('.navbar-menu-wrapper').css('width',
            //             'calc(100% - 75px)'); // Adjust menu wrapper width
            //         $('.collapse').removeClass('show');
            //         $('.main-panel').css('width', 'calc(100% - 75px)'); // Adjust main panel width

            //         if ($(window).width() <= 991) {
            //             $('.main-panel').css('width', '100%'); // Set width to 100% on small screens
            //         }
            //     } else {
            //         navBar.css('width', '235px'); // Move the button
            //         $('.navbar-brand-wrapper').css('width', '235px'); // Adjust brand logo width
            //         $('#logo_image').attr('src', "{{ asset('images/Hi-Tech Water Logo (ENG).png') }}");
            //         $('#logo_image').css('marginLeft', '0');
            //         $('.navbar-menu-wrapper').css('width',
            //             'calc(100% - 235px)'); // Adjust menu wrapper width
            //         $('.main-panel').css('width', 'calc(100% - 235px)'); // Adjust main panel width
            //     }
            // });


            var navBar = $('#sidebar');
            var imageBig = "{{ asset('images/Hi-Tech Water Logo (ENG).png') }}";
            var imageSmall = "{{ asset('images/Hi-Tech-favicon.png') }}";

            function checkWidth() {
                if ($(window).width() <= 991) {
                    // check screen with <=911 (main panel width 100%, sidebar width 0, navbar brand width 75px)
                    navBar.css('width', '0'); // Move the button
                    $('.navbar-brand-wrapper').css('width', '75px'); //
                    $('.navbar-menu-wrapper').css('width', 'calc(100% - 75px)'); // Adjust menu wrapper width
                    $('.main-panel').css('width', '100%'); // Adjust main panel width
                    $('.collapse').removeClass('show');

                } else {
                    // left sidebar when reside > 991

                    // right menu bar
                    $(document).on('click', '#sidebarBtnRight', function() {
                        navBar.css('width', '235px'); // Move the button
                        $('.navbar-menu-wrapper').css('width',
                            'calc(100% - 0)'); // Adjust menu wrapper width
                        $('.main-panel').css('width', 'calc(100% - 0)'); // Adjust main panel width
                    });

                    // check session
                    @if (session('click_sidebar') == true)
                        navBar.css('width', '75px'); // Hide the sidebar
                        $('.navbar-brand-wrapper').css('width', '75px'); // Adjust brand logo width
                        $('#logo_image').attr('src', imageSmall);
                        $('#logo_image').css('marginLeft', '20px');
                        $('.navbar-menu-wrapper').css('width', 'calc(100% - 75px)'); // Adjust menu wrapper width
                        $('.collapse').collapse('hide'); // Hide the collapse menu
                        $('.main-panel').css('width', 'calc(100% - 75px)'); // Adjust main panel width
                    @else
                        // left side bar if no sessino
                        // navBar.css('width', '235px'); // Move the button
                        // $('.navbar-brand-wrapper').css('width', '235px'); //
                        // $('.navbar-menu-wrapper').css('width', 'calc(100% - 235px)'); // Adjust menu wrapper width
                        // $('.main-panel').css('width', 'calc(100% - 235px)'); // Adjust main panel width
                        // $('#logo_image').attr('src', "{{ asset('images/Hi-Tech Water Logo (ENG).png') }}");

                        navBar.css('width', '235px'); // Hide the sidebar
                        $('.navbar-brand-wrapper').css('width', '235px'); // Adjust brand logo width
                        $('#logo_image').attr('src', imageBig);
                        $('#logo_image').css('marginLeft', '20px');
                        $('.navbar-menu-wrapper').css('width',
                            'calc(100% - 235px)'); // Adjust menu wrapper width
                        // $('.collapse').removeClass('show');
                        $('.main-panel').css('width', 'calc(100% - 235px)'); // Adjust main panel width
                    @endif
                }
            }
            checkWidth();

            $(window).resize(function() {
                checkWidth();
            });


            // left menu bar
            $(document).on('click', '#navBarButton', function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getClickSidebar') }}",
                    dataType: "json",
                    success: function(response) {
                        if (navBar.css('width') === '235px') {
                            navBar.css('width', '75px'); // Hide the sidebar
                            $('.navbar-brand-wrapper').css('width',
                                '75px'); // Adjust brand logo width
                            $('#logo_image').attr('src', imageSmall);
                            $('#logo_image').css('marginLeft', '20px');
                            $('.navbar-menu-wrapper').css('width',
                                'calc(100% - 75px)'); // Adjust menu wrapper width
                            $('.collapse').removeClass('show');
                            $('.main-panel').css('width',
                                'calc(100% - 75px)'); // Adjust main panel width

                            if ($(window).width() <= 991) {
                                $('.main-panel').css('width',
                                    '100%'); // Set width to 100% on small screens
                            }
                        } else {
                            navBar.css('width', '235px'); // Move the button
                            $('.navbar-brand-wrapper').css('width',
                                '235px'); // Adjust brand logo width
                            $('#logo_image').attr('src', imageBig);
                            $('#logo_image').css('marginLeft', '0');
                            $('.navbar-menu-wrapper').css('width',
                                'calc(100% - 235px)'); // Adjust menu wrapper width
                            $('.main-panel').css('width',
                                'calc(100% - 235px)'); // Adjust main panel width
                        }
                    }
                });
            });

            // right menu bar
            $(document).on('click', '#sidebarBtnRight', function() {
                navBar.css('width', '235px'); // Move the button
                $('.navbar-menu-wrapper').css('width',
                    'calc(100% - 0)'); // Adjust menu wrapper width
                $('.main-panel').css('width', 'calc(100% - 0)'); // Adjust main panel width
            });
        });
    </script>
    @yield('js')

</body>

</html>
