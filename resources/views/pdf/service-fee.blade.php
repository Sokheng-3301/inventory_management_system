<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }} | IMS</title>
    <style>
        @font-face {
            font-family: 'KhmerOS';
            src: url('{{ public_path('fonts/Notosan/khmerOs.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'KhmerOS', sans-serif;
            font-size: 11px !important;
        }

        table {
            border-collapse: collapse;
            width: 100%;

        }

        th,
        td {
            border: 0.1px solid #868686;
            padding: 4px 5px;
        }

        .text-center {
            text-align: center;
        }

        h3 {
            line-height: 5px;
        }

        .w-x {
            width: 25px;
        }
    </style>
</head>

<body>
    <h3>{{ $title }}</h3>
    <p>Export Date : {{ now()->format('d M Y h:i:s A') }}</p>
    <table>
        <thead>
            <tr>
                <th>{{ __('home.no') }}</th>
                <th> {{ __('nav.aboutService') }} </th>
                <th> {{ __('nav.expenseDate') }} </th>
                <th> {{ __('nav.createBy') }} </th>
                <th> {{ __('nav.price') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($items as $key => $item)
                @php
                    $total += $item->price;
                @endphp
                <tr>
                    <td>
                        {{ $key + 1 }}
                    </td>

                    <td class="text">
                        <p class="text-break">{{ $item->note }}</p>
                    </td>

                    <td>
                        {{ Carbon\Carbon::parse($item->date)->format('d M Y') }}
                    </td>

                    <td class="text-muted">
                        {{ strtoupper($item->add_by) }}
                    </td>

                    <td class="text-end fw-bold">
                        $ {{ $item->price }}
                    </td>

                </tr>
            @endforeach

            <!-- Add more rows as needed -->
        </tbody>
        <tbody>
            <tr>
                <td class="text-danger fw-bold fs-6 text-end" colspan="4"> {{ __('nav.total') }} </td>
                <td class="text-end fw-bold fs-5 text-end">$ {{ $total }} </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
