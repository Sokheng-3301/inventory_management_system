@extends('layout/master')

@section('title')
    <title> {{ __('nav.appName') }} </title>
@endsection

@section('css')
    <style>
        h1 {
            color: #333;
            text-align: center;
        }

        h4 {
            color: #555;
            margin-top: 10px !important;
            text-align: end
        }

        .weekdays {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0px;
            font-weight: bold;
        }

        .weekday {
            width: calc(100% / 7);
            text-align: center;
            background-color: #fff0dce8;
            padding: 8px !important;
            border: 0.5px solid #ddd;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0px;
        }

        .calendar-day {
            padding: 8px;
            text-align: center;
            border: 0.5px solid #ddd;
            /* border-radius: 4px; */
        }

        .other-month {
            color: #aaa;
        }

        .today {
            background-color: #fff0dce8;
            font-weight: bold;
        }

        .height-fit {
            height: fit-content;
        }

        .mark_itepurchase {
            width: 10px;
            height: 10px;
            background-color: #4747A1;
            border-radius: 50%;
            margin-right: 10px;
        }

        .text-mark_itepurchase {
            color: #4747A1;
            font-size: 9px;
        }

        .mark_serviceFee {
            width: 10px;
            height: 10px;
            background-color: #F09397;
            border-radius: 50%;
            margin-right: 10px;
        }

        .text-mark_serviceFee {
            color: #F09397;
            font-size: 9px;
        }

        .fixed-height {
            height: 311px !important;
            overflow-y: auto;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.dashboard') }}</h3>
                        <h6 class="font-weight-normal mb-0 text-primary">{{ __('home.welcome') }}
                            {{-- {{ session('lock_screen') ? 'Sidebar Clicked' : '' }} --}}
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <div class="row">
                    {{-- all product  --}}
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-tale card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">{{ __('nav.allItem') }}</p>
                                <p class="fs-30 mb-2">
                                    {{ $count_item }}
                                </p>
                            </div>
                        </div>
                    </div>


                    {{-- Instock product  --}}
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-tale card-dark-indigo">
                            <div class="card-body">
                                <p class="mb-4">{{ __('home.proInstock') }}</p>
                                <p class="fs-30 mb-2">
                                    {{ $instock }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Given product  --}}
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">{{ __('nav.proGiven') }}</p>
                                <p class="fs-30 mb-2">
                                    {{ $given_item }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Outstock product   --}}
                    <div class="col-md-3 mb-4 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">{{ __('home.proOutstock') }}</p>
                                <p class="fs-30 mb-2">
                                    {{ $outstock }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>

        {{-- filter here by year  --}}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title" data-bs-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample"><i class="ui filter icon"></i>
                            {{ __('nav.filterData') }}</p>

                        <div class="collapse {{ request('year') ? 'show' : '' }}" id="collapseExample">
                            <form action="" autocomplete="off" method="get" class="ui form">
                                <div class="two fields">
                                    <div class="field">
                                        <label for="year">{{ __('nav.selectYear') }}</label>
                                        <select name="year" id="year" class="ui dropdown search scrolling">
                                            <option value="">{{ __('nav.selectYear') }}</option>
                                            @for ($i = 2020; $i <= now()->year; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('year') == $i ? 'selected' : '' }}>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label for="">&nbsp;</label>
                                        <button class="ui button black" type="submit">
                                            <i class="ui search icon"></i>
                                            {{ __('nav.search') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">{{ __('nav.expenseReport') . ' ' . (request('year') ?? now()->year) }}</p>
                        {{-- <p class="font-weight-500">{{ __('nav.expenseTitle') }}</p> --}}
                        <div class="d-flex flex-wrap mb-3 justify-content-between align-items-center">

                            <div class="mr-5 mt-2">
                                <p class="text-muted">{{ __('nav.expenseITEPurchase') }}</p>
                                <h3 class="text-primary fs-30 font-weight-medium">{{ formatExpense($expenseITE) }}</h3>
                            </div>
                            <div class="mr-5 mt-2">
                                <p class="text-muted">{{ __('nav.expenseServiceFee') }}</p>
                                <h3 class="text-primary fs-30 font-weight-medium">{{ formatExpense($expenseServiceFee) }}</h3>
                            </div>

                            <div class="mr-5 mt-2">
                                <p class="text-danger">{{ __('nav.totalExpense') }}</p>
                                <h3 class="text-danger fs-30 font-weight-medium">{{ formatExpense($expenseTotal) }}</h3>
                            </div>
                            {{-- <div class="mt-3">
                                <p class="text-muted">Downloads</p>
                                <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                            </div> --}}

                        </div>
                        <div class="row mb-3">
                            <div class="col-12 text-end">
                                <div class="d-flex align-items-center">
                                    <div class="mark_itepurchase"></div>
                                    <small class="text-mark_itepurchase">{{ __('nav.ItePurchase') }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="mark_serviceFee"></div>
                                    <small class="text-mark_serviceFee">{{ __('nav.serviceFee') }}</small>
                                </div>
                            </div>
                        </div>

                        <canvas id="order-chart"></canvas>
                    </div>
                </div>
            </div>


            {{-- Calendar --}}
            <div class="col-md-5 grid-margin stretch-card height-fit">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">{{ __('nav.calendar') }}</p>
                        <div id='calendar-container'>
                            <h4>{{ __('nav.today') }}</h4>
                            <p class="text-end">{{ now()->format('M Y') }}</p>
                            <div class="weekdays">
                                <div class="weekday">Sun</div>
                                <div class="weekday">Mon</div>
                                <div class="weekday">Tue</div>
                                <div class="weekday">Wed</div>
                                <div class="weekday">Thu</div>
                                <div class="weekday">Fri</div>
                                <div class="weekday">Sat</div>
                            </div>
                            <div class="calendar-grid" id="calendar">
                                <!-- Calendar days will be generated by jQuery -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- //////// STATISTIC PRODUCT ////////// --}}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card position-relative">
                    <div class="card-body">
                        <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                            data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">{{ __('nav.itemStatistic') }}</p>

                                                <h1 class="text-primary">{{ $count_item }}</h1>
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">{{ __('nav.allItems') }}
                                                </h3>
                                                <p class="mb-2 mb-xl-0">{{ __('nav.allItemInfo') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-6 border-right fixed-height">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            @foreach ($item_code_counts as $key => $count_itemcode)
                                                                <tr>
                                                                    <td class="text-primary fw-bold text">
                                                                        <p class="d-block w-100">
                                                                            {{ $count_itemcode->item_code }}</p>
                                                                        <small
                                                                            class="d-block text-wrap text-break text-muted">{{ session('localization') == 'kh' ? $count_itemcode->item_name_kh : $count_itemcode->item_name_en }}</small>
                                                                    </td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-2">
                                                                            <div class="progress-bar {{ $key % 2 == 0 ? 'bg-primary' : 'bg-warning' }} {{ $key % 3 == 0 ? 'bg-danger' : '' }}"
                                                                                role="progressbar"
                                                                                style="width: {{ ($count_itemcode->total_qty / 100) * 100 }}%"
                                                                                aria-valuenow="{{ ($count_itemcode->total_qty / 100) * 100 }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">
                                                                            {{ $count_itemcode->total_qty }}</h5>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3 ">
                                                    <div class="ml-xl-4 mt-3">
                                                        <p class="card-title">{{ __('nav.returnOutlist') }}</p>
                                                    </div>

                                                    <canvas id="north-america-chart"></canvas>
                                                    {{-- <div id="north-america-legend"></div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                            <div class="ml-xl-4 mt-3">
                                                <p class="card-title">{{ __('nav.itemGiven') }}</p>
                                                <h1 class="text-primary">{{ $given_item }}</h1>
                                                <h3 class="font-weight-500 mb-xl-4 text-primary">{{ __('nav.proGiven') }}
                                                </h3>
                                                <p class="mb-2 mb-xl-0">{{ __('nav.allItemGivenInfo') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-12 border-right fixed-height">
                                                    <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                        <table class="table table-borderless report-table">
                                                            @php
                                                                $key = 1;
                                                            @endphp
                                                            @foreach ($item_given_counts_byCode as $code => $data)
                                                                <tr>
                                                                    <td class="text-primary fw-bold text w-20">
                                                                        <p class="d-block w-100">
                                                                            {{ $code }}</p>
                                                                        <small
                                                                            class="d-block text-wrap text-break text-muted">{{ session('localization') == 'kh' ? $data['name_kh'] : $data['name_en'] }}</small>
                                                                    </td>
                                                                    <td class="w-100 px-0">
                                                                        <div class="progress progress-md mx-2">
                                                                            <div class="progress-bar {{ $key % 2 == 0 ? 'bg-primary' : 'bg-warning' }} {{ $key % 3 == 0 ? 'bg-danger' : '' }}"
                                                                                role="progressbar"
                                                                                style="width: {{ ($data['count'] / 100) * 100 }}%"
                                                                                aria-valuenow="{{ ($data['count'] / 100) * 100 }}"
                                                                                aria-valuemin="0" aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <h5 class="font-weight-bold mb-0">
                                                                            {{ $data['count'] }}</h5>
                                                                    </td>
                                                                </tr>
                                                                @php
                                                                    $key++;
                                                                @endphp
                                                            @endforeach

                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-6 mt-3">
                                                    <canvas id="south-america-chart"></canvas>
                                                    <div id="south-america-legend"></div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- //// BAR CHART //////  --}}
        {{-- <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p class="card-title">Sales Report</p>
                            <a href="#" class="text-info">View all</a>
                        </div>
                        <p class="font-weight-500">The total number of sessions within the date range. It is the period
                            time a user is actively engaged with your website, page or app, etc</p>
                        <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                        <canvas id="sales-chart"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- block user account  --}}
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">{{ __('home.blockAcc') }}</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>{{ __('home.no') }}</th>
                                                <th>{{ __('home.userProfile') }}</th>
                                                <th>{{ __('home.cardId') }}</th>
                                                <th>{{ __('home.username') }}</th>
                                                <th>{{ __('home.Gender') }}</th>
                                                <th>{{ __('home.Position') }}</th>
                                                <th>{{ __('nav.blockAt') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                            @endphp
                                            @foreach ($blocked_account as $ba)
                                                <tr>
                                                    <td class="text-danger">{{ $auto++ }}</td>
                                                    <td class="text-danger">
                                                        @if ($ba->profile != '')
                                                            <img src="{{ asset($ba->profile) }}" alt="user profile">
                                                        @else
                                                            <img src="{{ asset('images/draft-user.jpg') }}"
                                                                alt="use profile">
                                                        @endif
                                                    </td>
                                                    <td class="text-danger">{{ $ba->card_id }}</td>
                                                    <td class="text-danger">{{ $ba->name_en }}</td>
                                                    <td class="text-danger">
                                                        @if ($ba->gender == 'Male')
                                                            <span class="mdi mdi-gender-male"></span>
                                                        @else
                                                            <span class="mdi mdi-gender-female"></span>
                                                        @endif
                                                    </td>
                                                    <td class="text-danger">{{ $ba->position_name }}</td>
                                                    <td class="text-danger">
                                                        {{ Carbon\Carbon::parse($ba->block_date)->format('d M Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{-- <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Quote#</th>
                                                <th>Product</th>
                                                <th>Business type</th>
                                                <th>Policy holder</th>
                                                <th>Premium</th>
                                                <th>Status</th>
                                                <th>Updated at</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                    </table> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('calendar/calendar.global.js') }}"></script>
    {{-- @if (session()->has('welcome'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Welcome to Hitech Inventory Management System"
            });
        </script>
    @endif --}}


    <script>
        $(document).ready(function() {
            $('#home').addClass('nav-item active');

            $(document).ready(function() {
                // Get current date
                const today = new Date();
                const currentMonth = today.getMonth();
                const currentYear = today.getFullYear();
                const currentDay = today.getDate();

                // Get first day of month
                const firstDay = new Date(currentYear, currentMonth, 1);
                const startingDay = firstDay.getDay(); // 0-6 (Sun-Sat)

                // Get days in month
                const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

                // Get days from previous month to show
                const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();
                let daysFromPrevMonth = startingDay;

                // Get days from next month to show (total cells should be divisible by 7)
                const totalCells = Math.ceil((daysInMonth + daysFromPrevMonth) / 7) * 7;
                const daysFromNextMonth = totalCells - (daysInMonth + daysFromPrevMonth);

                // Generate calendar
                let calendarHTML = '';

                // Previous month days
                for (let i = daysFromPrevMonth; i > 0; i--) {
                    const day = prevMonthDays - i + 1;
                    calendarHTML += `<div class="calendar-day other-month">${day}</div>`;
                }

                // Current month days
                for (let i = 1; i <= daysInMonth; i++) {
                    const dayClass = (i === currentDay) ? 'calendar-day today' : 'calendar-day';
                    calendarHTML += `<div class="${dayClass}">${i}</div>`;
                }

                // Next month days
                for (let i = 1; i <= daysFromNextMonth; i++) {
                    calendarHTML += `<div class="calendar-day other-month">${i}</div>`;
                }

                // Insert into DOM
                $('#calendar').html(calendarHTML);
            });
        });

        $(function() {
            if ($("#order-chart").length) {
                var areaData = {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                            data: [
                                @foreach ($monthsITEPurchase as $month)
                                    "{{ $month }}",
                                @endforeach
                            ],
                            borderColor: [
                                '#4747A1'
                            ],
                            borderWidth: 2,
                            fill: false,
                            label: "{{ __('nav.ItePurchase') }}"
                        },
                        {
                            data: [
                                @foreach ($monthsService as $service)
                                    "{{ $service }}",
                                @endforeach
                            ],
                            borderColor: [
                                '#F09397'
                            ],
                            borderWidth: 2,
                            fill: false,
                            label: "{{ __('nav.serviceFee') }}"
                        }
                    ]
                };
                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                padding: 10,
                                fontColor: "#6C7383"
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false,
                                color: 'transparent',
                                zeroLineColor: '#eeeeee'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                autoSkip: false,
                                maxRotation: 0,
                                stepSize: 100,
                                min: 0,
                                max: {{ $max_value == 0 ? 1000 : $max_value }},
                                callback: function(value, index, values) {
                                    return '$ ' + value;
                                },
                                padding: 18,
                                fontColor: "#6C7383"
                            },
                            gridLines: {
                                display: true,
                                color: "#f2f2f2",
                                drawBorder: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                    elements: {
                        line: {
                            tension: .35
                        },
                        point: {
                            radius: 0
                        }
                    }
                }
                var revenueChartCanvas = $("#order-chart").get(0).getContext("2d");
                var revenueChart = new Chart(revenueChartCanvas, {
                    type: 'line',
                    data: areaData,
                    options: areaOptions
                });
            }

            if ($("#north-america-chart").length) {
                var areaData = {
                    labels: [
                        @foreach ($countReturnOulistByItemCode as $oulistItemCode)
                            "{{ $oulistItemCode->item_code }}",
                        @endforeach
                    ],
                    datasets: [{
                        data: [
                            @foreach ($countReturnOulistByItemCode as $oulistItemCode)
                                "{{ $oulistItemCode->total_qty }}",
                            @endforeach
                        ],
                        backgroundColor: [
                            @foreach ($countReturnOulistByItemCode as $key => $oulistItemCode)
                                "{{ $key % 2 == 0 ? '#4B49AC' : ($key % 3 == 0 ? '#FFC100' : '#248AFD') }}",
                            @endforeach
                        ],
                        borderColor: "rgba(0,0,0,0)"
                    }]
                };
                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    segmentShowStroke: false,
                    cutoutPercentage: 78,
                    elements: {
                        arc: {
                            borderWidth: 4
                        }
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<div class="report-chart">');
                        text.push(
                            '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                            chart.data.datasets[0].backgroundColor[0] +
                            '"></div><p class="mb-0">Offline sales</p></div>');
                        text.push('<p class="mb-0">88333</p>');
                        text.push('</div>');
                        text.push(
                            '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                            chart.data.datasets[0].backgroundColor[1] +
                            '"></div><p class="mb-0">Online sales</p></div>');
                        text.push('<p class="mb-0">66093</p>');
                        text.push('</div>');
                        text.push(
                            '<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' +
                            chart.data.datasets[0].backgroundColor[2] +
                            '"></div><p class="mb-0">Returns</p></div>');
                        text.push('<p class="mb-0">39836</p>');
                        text.push('</div>');
                        text.push('</div>');
                        return text.join("");
                    },
                }
                var northAmericaChartPlugins = {
                    beforeDraw: function(chart) {
                        var width = chart.chart.width,
                            height = chart.chart.height,
                            ctx = chart.chart.ctx;

                        ctx.restore();
                        var fontSize = 3.125;
                        ctx.font = "500 " + fontSize + "em sans-serif";
                        ctx.textBaseline = "middle";
                        ctx.fillStyle = "#13381B";

                        var text = "{{ $old_item_count }}",
                            textX = Math.round((width - ctx.measureText(text).width) / 2),
                            textY = height / 2;

                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }
                var northAmericaChartCanvas = $("#north-america-chart").get(0).getContext("2d");
                var northAmericaChart = new Chart(northAmericaChartCanvas, {
                    type: 'doughnut',
                    data: areaData,
                    options: areaOptions,
                    plugins: northAmericaChartPlugins
                });
                document.getElementById('north-america-legend').innerHTML = northAmericaChart.generateLegend();
            }
        });
    </script>
@endsection
