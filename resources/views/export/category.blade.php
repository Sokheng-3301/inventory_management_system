<h4>Export: {{ $title }}</h4>
<p>Export Date: {{ now()->format('d M Y h:i:s A') }}</p>
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
                <td>{{ $key+1 }}</td>
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
