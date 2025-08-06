<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
<table>
    <thead>
        <tr>
            <th>{{ __('home.no') }}</th>
            <th> {{ __('nav.staffId') }} </th>
            <th> {{ __('nav.name') }} </th>
            <th> {{ __('nav.department') }} </th>
            <th> {{ __('nav.section') }} </th>
            <th> {{ __('nav.position') }} </th>

            <th> {{ __('nav.proCode') }} </th>
            <th> {{ __('nav.proName') }} </th>
            <th> {{ __('nav.model') }} </th>
            <th> {{ __('nav.serial_number') }} </th>
            <th> {{ __('nav.fix_asset_code') }} </th>

            <th> {{ __('nav.status') }} </th>
            <th> {{ __('nav.returnDate') }} </th>
            <th> {{ __('nav.receiveBy') }} </th>
        </tr>
    </thead>
    <tbody>
        @php
            $auto = 1;
        @endphp
        @foreach ($items as $item)
            <tr>
                <td>{{ $auto++ }}</td>
                <td>{{ $item->card_id ?? __("nav.newStaff")}}</td>
                <td>{{ $item->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }} {{ $item->name_kh .' - '. $item->name_en }}</td>
                <td>{{ $item->dep_name_kh . ' - '. $item->dep_name_kh }}</td>
                <td>{{ $item->section_kh . ' - '. $item->section_en }}</td>
                <td>{{ $item->position_name }}</td>

                <td>{{ $item->item_code }}</td>
                <td>{{ session('localization') == 'kh' ? $item->item_name_kh : $item->item_name_en }}</td>
                <td>{{ $item->model }}</td>
                <td>{{ $item->serial_number }}</td>
                <td>{{ $item->fix_asset_code }}</td>


                <td>
                    {{ $item->item_status }}
                </td>

                <td>
                    {{ Carbon\Carbon::parse($item->returned_date)->format('d M Y h:i:s A') }}
                </td>

                <td>
                    {{ strtoupper($item->recieve_by) }}
                </td>


            </tr>
        @endforeach
    </tbody>
</table>
