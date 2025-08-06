<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ __('nav.staffList') }} | IMS</title>
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
                <th> {{ __('nav.staffInfo') }} </th>
                <th> {{ __('nav.position') }} </th>
                <th class="text-center">{{ __('nav.gender') }}</th>
                <th class="text-start"> {{ __('nav.createAt') }} </th>
            </tr>
        </thead>
        <tbody>

            @foreach ($staffs as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <td>
                        <p><span class="text-muted">ID :</span> {!! $item->card_id ?? '<span class="text-primary">' . __('nav.newStaff') . '</span>' !!}</p>
                        <p>{{ $item->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }}
                            {{ $item->name_kh }}</p>
                        <p class="text-uppercase">
                            {{ $item->gender == 'Male' ? 'Mr.' : 'Miss.' }}
                            {{ $item->name_en }}</p>
                    </td>
                    <td>
                        <p><span class="text-muted">Dept : </span><span
                                class="text-uppercase">{{ $item->dep_name_kh . ' - ' . $item->dep_name_en }}</span>
                        </p>
                        <p><span class="text-muted">Sect : </span><span
                                class="text-uppercase">{{ $item->section_kh . ' - ' . $item->section_en }}</span>
                        </p>
                        <p><span class="text-muted">Post :
                            </span>{{ $item->position_name }}</p>
                    </td>

                    <td>
                        @if ($item->gender == 'Male')
                            {{ __('nav.male') }}
                        @else
                            {{ __('nav.female') }}
                        @endif
                    </td>

                    <td>
                        <p class="text-uppercase">{{ $item->create_by }}</p>
                        <p class="text-muted">
                            {{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i:s A') }}
                        </p>
                    </td>
                </tr>
            @endforeach

            <!-- Add more rows as needed -->
        </tbody>
    </table>

</body>

</html>
