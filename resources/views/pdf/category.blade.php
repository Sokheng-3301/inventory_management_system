<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ __('nav.category') }} | IMS</title>
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
                <th>{{ __('nav.categoryName') }}</th>
                <th> {{ __('nav.createAt') }} </th>
                <th> {{ __('nav.createBy') }} </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($categories as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{ $item->cat_name }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($item->create_date)->format('d M Y h:i:s A') }}
                    </td>
                    <td>
                        {{ $item->add_by }}
                    </td>
                </tr>
            @endforeach

            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>

</html>
