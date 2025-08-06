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

        .text-end {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h3>{{ $title }}</h3>
    <p>Export Date : {{ now()->format('d M Y h:i:s A') }}</p>
    <table id="myTable" class="display table table-striped">
        <thead>
            <tr>
                <th>{{ __('home.no') }}</th>
                <th> {{ __('nav.staffInfo') }} </th>
                <th> {{ __('nav.itemReturn') }} </th>
                <th> {{ __('nav.status') }} </th>
                <th> {{ __('nav.returnDate') }} </th>
                <th> {{ __('nav.receiveBy') }} </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>

                    <td class="text">
                        <p><span class="text-muted">ID : </span> {!! $item->card_id ?? '<span class="text-info">' . __('nav.newStaff') . '</span>' !!}</p>
                        <p class="text-capitalize"><span
                                class="text-muted">{{ $item->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }}</span>
                            {{ $item->name_kh . ' - ' . $item->name_en }}</p>
                        <p><span class="text-muted">Dept : </span>
                            {{ $item->dep_name_kh . ' - ' . $item->dep_name_en }}</p>
                        <p><span class="text-muted">Sect : </span>
                            {{ $item->section_kh . ' - ' . $item->section_en }}</p>
                        <p><span class="text-muted">Post : </span>
                            {{ $item->position_name }}</p>
                    </td>

                    <td class="text">
                        <p>
                            <span class="text-muted">Code.</span>
                            {{ $item->item_code ?? 'N/A' }}
                        </p>
                        <p>
                            <span class="text-muted">Item.</span> {{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}
                        </p>

                        <p>
                            <span class="text-muted">SN.</span>
                            {{ $item->serial_number ?? 'N/A' }}
                        </p>
                        <p>
                            <span class="text-muted">FAC.</span>
                            {{ $item->fix_asset_code ?? 'N/A' }}
                        </p>
                        <p>
                            <span class="text-muted">Mod.</span>
                            {{ $item->model ?? 'N/A' }}
                        </p>
                    </td>

                    <td class="text-break">
                        {{ $item->item_status }}
                    </td>

                    <td class="text-muted">
                        {{ Carbon\Carbon::parse($item->returned_date)->format('d M Y h:i:s A') }}
                    </td>

                     <td class="text-break">
                        {{ strtoupper($item->recieve_by) }}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
