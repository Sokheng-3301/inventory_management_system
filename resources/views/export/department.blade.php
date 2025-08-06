<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
<table>
    <thead>
        <tr>
            <th>{{ __('home.no') }}</th>
            <th>{{ __('nav.depCode') }}</th>
            <th>{{ __('nav.depNameKh') }}</th>
            <th>{{ __('nav.depNameEn') }}</th>
            <th>{{ __('nav.createBy') }}</th>
            <th>{{ __('nav.createAt') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($departments as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    {{ $item->department_code }}
                </td>
                <td>
                    {{ $item->dep_name_kh }}
                </td>
                <td>
                    {{ $item->dep_name_en }}
                </td>
                <td>
                    {{ $item->add_by }}
                </td>
                <td>
                    {{ Carbon\Carbon::parse($item->create_date)->format('d M Y h:i:s A') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
