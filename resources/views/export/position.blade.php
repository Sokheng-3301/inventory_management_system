<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
<table>
    <thead>
        <tr>
            <th>{{ __('home.no') }}</th>
            <th>{{ __('nav.position') }}</th>
            <th>{{ __('nav.section') }}</th>
            <th>{{ __('nav.department') }}</th>
            <th>{{ __('nav.createBy') }}</th>
            <th>{{ __('nav.createAt') }}</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($positions as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->position_name }}</td>
                <td>{{ $item->section_en }}</td>
                <td>{{ $item->dep_name_en }}</td>
                <td>{{ $item->add_by }}</td>
                <td>{{ Carbon\Carbon::parse($item->create_date)->format('d M Y h:i:s A') }}</td>
            </tr>
        @endforeach

        <!-- Add more rows as needed -->
    </tbody>
</table>
