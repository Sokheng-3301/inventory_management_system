<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
<table>
    <thead>
        <tr>
            <th>{{ __('home.no') }}</th>
            <th> {{ __('nav.staffId') }} </th>
            <th> {{ __('nav.fullNameKh') }} </th>
            <th> {{ __('nav.fullNameEn') }} </th>
            <th>{{ __('nav.gender') }}</th>
            <th> {{ __('nav.position') }} </th>
            <th> {{ __('nav.section') }} </th>
            <th> {{ __('nav.department') }} </th>
            <th> {{ __('nav.createBy') }} </th>
            <th> {{ __('nav.createAt') }} </th>
        </tr>
    </thead>
    <tbody>

        @foreach ($staffs as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->card_id ?? __('nav.newStaff') }}</td>
                <td>{{ $item->name_kh ?? 'N/A' }}</td>
                <td>{{ $item->name_en ?? 'N/A' }}</td>
                <td>
                    @if ($item->gender == 'Male')
                        {{ __('nav.male') }}
                    @else
                        {{ __('nav.female') }}
                    @endif
                </td>
                <td>{{ $item->position_name }}</td>
                <td>{{ $item->section_kh . ' - ' . $item->section_en }}</td>
                <td>{{ $item->dep_name_kh . ' - ' . $item->dep_name_en }}</td>
                <td>{{ $item->create_by }}</td>
                <td>
                    {{ Carbon\Carbon::parse($item->created_at)->format('d M Y h:i:s A') }}
                </td>
            </tr>
        @endforeach

        <!-- Add more rows as needed -->
    </tbody>
</table>
