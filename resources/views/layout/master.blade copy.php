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

        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: #4069a3;
            z-index: 999999;
            text-align: center;
            transition: transform 0.3s, opacity 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #preloader.fade-out {
            transform: translateY(-100%);
            opacity: 0;
        }

        #preloadImg {
            width: 15%;
            backdrop-filter: 15px;
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
            width: 48px;
            height: 48px;
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

            <!-- dribbble -->
            {{-- <a class="dribbble" href="https://dribbble.com/shots/5557955-Infinity-Loader" target="_blank"><img
                    src="https://cdn.dribbble.com/assets/dribbble-ball-mark-2bd45f09c2fb58dbbfb44766d5d1d07c5a12972d602ef8b32204d28fa3dda554.svg"
                    alt=""></a> --}}
        </div>
    @endsession


    @if (!session('success') && !session('error') && !session('confirmSubmit'))
        {{-- preloader --}}
        <div id="window_preloader">
            <div class="loader"></div>
        </div>
    @endif




    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="/"><img
                        src="{{ asset('images/Hi-Tech Water Logo (ENG).png') }}" class="mr-2" alt="logo" /></a>
                {{-- <a class="navbar-brand brand-logo mr-5" href="/"><img src="{{asset('images/Hi-Tech-favicon.png')}}" alt="logo" /></a> --}}
                <a class="navbar-brand brand-logo-mini" href="/"><img
                        src="{{ asset('images/Hi-Tech-favicon.png') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    {{-- <i class="fas fa-bars"></i> --}}
                    <span class="mdi mdi-menu fs-3"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $checkRole->role_name == 'Super Admin')
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
                                        // ->exists();
                                    @endphp
                                    @foreach ($notification as $n)
                                        <a class="dropdown-item preview-item" href="{{ route('request.index') }}">
                                            <div class="preview-thumbnail">
                                                <div class="preview-icon bg-success">
                                                    {{-- <i class="ti-info-alt mx-0"></i> --}}
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
                    @endif

                    <li class="nav-item dropdown">
                        <a type="button" class="d-flex align-items-center badge badge-light " data-toggle="dropdown"
                            id="language">
                            {{-- <span class="mdi mdi-web fs-5 text-primary pe-1"></span>  --}}
                            @if (session()->has('localization') && session('localization') == 'kh')
                                <img src="{{ asset('images/khmer-language.png') }}" alt="Khmer" class="pe-1"> KH
                                <span class="mdi mdi-menu-down fs-6"></span>
                            @else
                                <img src="{{ asset('images/english-language.png') }}" alt="English" class="pe-1"> EN
                                <span class="mdi mdi-menu-down fs-6"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="language">
                            <a class="dropdown-item" href="{{ route('localization', 'en') }}">
                                <img src="{{ asset('images/english-language.png') }}" alt="English">
                                <span class="d-inline-block ps-2">{{ __('nav.english') }}</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('localization', 'kh') }}">
                                <img src="{{ asset('images/khmer-language.png') }}" alt="Khmer">
                                <span class="d-inline-block ps-2">{{ __('nav.khmer') }}</span>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            @if (@Auth::user()->profile == '')
                                <img src="{{ asset('images/draft-user.jpg') }}" alt="profile" />
                            @else
                                <img src="{{ asset(@Auth::user()->profile) }}" alt="profile" />
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('account.profile') }}">
                                <i class="ti-user text-primary"></i>
                                @if (@Auth::user()->gender == 'Male')
                                    {{ __('nav.Mr') }}
                                @else
                                    {{ __('nav.Miss') }}
                                @endif
                                @if (session('localization') == 'kh')
                                    {{ @Auth::user()->name_kh }}
                                @else
                                    {{ @Auth::user()->name_en }}
                                @endif
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="ti-power-off text-primary"></i>
                                {{ __('nav.logout') }}
                            </a>
                        </div>
                    </li>
                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu fs-3"></span>
                </button>
            </div>
            @php
                $notifications = DB::table('borrows')
                    ->join('staff_users', 'borrows.staff_id', '=', 'staff_users.card_id')
                    ->join('users', 'borrows.staff_id', '=', 'users.card_id')
                    ->join('products', 'borrows.pro_id', 'products.id')
                    ->where('borrows.borrow_status', 1)
                    ->get();
            @endphp
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
            <!-- partial:partials/_sidebar.html -->

            {{-- ---sidebar here start ---  --}}
            <nav class="sidebar sidebar-offcanvas" id="sidebar">

                @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $checkRole->role_name == 'Super Admin')
                    <ul class="nav" id="sidebar-menu">
                        <li class="nav-item" id="home">
                            <a class="nav-link" href="/">
                                <i class="mdi mdi-home menu-icon"></i>
                                <span class="menu-title">{{ __('nav.dashboard') }}</span>
                            </a>
                        </li>

                        <li class="nav-item" id="master">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="mdi mdi-database-outline menu-icon"></i>
                                <span class="menu-title">{{ __('nav.master') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">

                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('category.list') }}">{{ __('nav.category') }}</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('item_code.index') }}">{{ __('nav.itemCode') }}</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('department.list') }}">{{ __('nav.department') }}</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('section.list') }}">{{ __('nav.section') }}</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('position.list') }}">{{ __('nav.position') }}</a>
                                    </li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('staff.index') }}">{{ __('nav.staffList') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item" id="product">
                            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                                aria-controls="form-elements">
                                <i class="mdi mdi-table menu-icon"></i>
                                <span class="menu-title">{{ __('nav.product') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="form-elements">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('product.instock') }}">{{ __('nav.productInStock') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('product.outstock') }}">{{ __('nav.productOutstock') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('product.statistic') }}">{{ __('nav.statistic') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('product.trashbin') }}">{{ __('nav.trashbin') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item" id="givenAndReturned">
                            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false"
                                aria-controls="error">
                                <i class="mdi mdi-hand-coin-outline menu-icon"></i>
                                <span class="menu-title">{{ __('nav.givenAndReturned') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="error">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('product.addGive') }}">{{ __('nav.addNewGive') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('product.givenList') }}">{{ __('nav.given') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('product.returned') }}">{{ __('nav.returned') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('returnOutList.index') }}">{{ __('nav.returnOutlist') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- Not need  --}}
                        {{-- <li class="nav-item" id="purchaseRequest">
                                <a class="nav-link" data-toggle="collapse" href="#purchasePr" aria-expanded="false"
                                    aria-controls="purchasePr">
                                    <i class="mdi mdi-shopping-outline menu-icon"></i>
                                    <span class="menu-title">{{ __('nav.productPurchase') }}</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="purchasePr">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('purchase.index') }}">{{ __('nav.purchasing') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('purchase.received') }}">{{ __('nav.receiveProduct') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item" id="request">
                                <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false"
                                    aria-controls="charts">
                                    <i class="mdi mdi-inbox-arrow-down-outline menu-icon"></i>
                                    <span class="menu-title">{{ __('nav.RequestAndBorrow') }}</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="charts">
                                    <ul class="nav flex-column sub-menu">
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('request.index') }}">{{ __('nav.newRequest') }}</a></li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('request.accepted') }}">{{ __('nav.Accepted') }}</a></li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('request.rejected') }}">{{ __('nav.Rejected') }}</a> </li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('product.viewReturn') }}">{{ __('nav.returnedList') }}</a>
                                        </li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('product.overdraft') }}">{{ __('nav.overdraftList') }}</a>
                                        </li>
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ route('request.history') }}">{{ __('nav.History') }}</a> </li>
                                    </ul>
                                </div>
                            </li> --}}
                        {{-- Not need --}}


                        {{-- <li class="nav-item" id="expense_report">
                            <a class="nav-link" href="{{ route('expense.report') }}">
                                <i class="mdi mdi-finance menu-icon"></i>
                                <span class="menu-title">{{ __('nav.expenseReport') }}</span>
                            </a>
                        </li> --}}

                        <li class="nav-item" id="expenseReportMain">
                            <a class="nav-link" data-toggle="collapse" href="#expenseReport" aria-expanded="false"
                                aria-controls="expenseReport">
                                <i class="mdi mdi-finance menu-icon"></i>
                                <span class="menu-title">{{ __('nav.expenseReport') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="expenseReport">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('expense.purchase.index') }}">{{ __('nav.ItePurchase') }}</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('expense.service.index') }}">{{ __('nav.serviceFee') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item" id="inventory_list">
                            <a class="nav-link" href="{{ route('reports.index') }}">
                                <i class="mdi mdi-chart-bar menu-icon"></i>
                                <span class="menu-title">{{ __('nav.report') }}</span>
                            </a>
                        </li>

                        <hr class="border border-white">


                        <li class="nav-item" id="users">
                            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                                aria-controls="tables">
                                <i class="mdi mdi-account-group-outline menu-icon"></i>
                                <span class="menu-title">
                                    {{ __('nav.manageUser') }}
                                </span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="tables">
                                <ul class="nav flex-column sub-menu">
                                    @php
                                        $role = DB::select('select * from user_roles where delete_status = ? ', [1]);

                                    @endphp
                                    @foreach ($role as $r)
                                        <li class="nav-item"> <a class="nav-link"
                                                href="{{ url('user/' . $r->id . '/' . $r->role_name) }}">{{ $r->role_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item" id="role">
                            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
                                aria-controls="icons">
                                <i class="mdi mdi-target-account menu-icon"></i>
                                <span class="menu-title">{{ __('nav.manageRole') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="icons">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('role.list') }}">{{ __('nav.Role') }}</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('permission.index') }}">{{ __('nav.userPermission') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </li>




                        <li class="nav-item" id="db">
                            <a class="nav-link" data-toggle="collapse" href="#export_db" aria-expanded="false"
                                aria-controls="export_db">
                                <i class="mdi mdi-cloud-upload-outline menu-icon"></i>
                                <span class="menu-title">{{ __('nav.backupData') }}</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="export_db">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link" type="button" class="btn btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#dataBackupForm">{{ __('nav.exportData') }}</a></li>
                                    {{-- <li class="nav-item"> <a class="nav-link" href="{{route('permission.index')}}">{{__('nav.userPermission')}}</a></li> --}}
                                </ul>
                            </div>
                        </li>
                    </ul>

                    {{-- ------------------ --}}
                @else
                    <ul class="nav" id="sidebar-menu">
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
                                    {{-- @elseif ($f->name == 'Expense Reports')
                                    <li class="nav-item" id="home">
                                        <a class="nav-link" href="{{ route('expense.report') }}">
                                            <i class="mdi mdi-finance menu-icon"></i>
                                            <span class="menu-title">{{ __('nav.expenseReport') }}</span>
                                        </a>
                                    </li> --}}
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
                                                                    {{-- @if (session('localization') == 'en') --}}
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
                                                                    {{-- {{$subData->name}} --}}
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
                    </ul>
                @endif
            </nav>
            {{-- ---sidebar here end ---  --}}
            <!-- partial -->

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
                                            $(document).on('click', '#printButton', function() {window.print();});
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
    @yield('js')

</body>

</html>
