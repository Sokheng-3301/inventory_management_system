@extends('layout/master')
@section('link')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('title')
    <title>{{ __('nav.userPermission') }} | IMS</title>
@endsection

@section('css')
    <style>
        table.dataTable th.dt-type-numeric,
        table.dataTable th.dt-type-date,
        table.dataTable td.dt-type-numeric,
        table.dataTable td.dt-type-date {
            text-align: start;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.userPermission') }}</h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.manageRole') }} / <span class="text-primary">
                                <a class="text-primary" href="">{{ __('nav.userPermission') }}</a></span>
                        </h6>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-12 col-md-7 col-l-7 col-xl-7">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <p class="fw-bold fs-5">{{ __('nav.mangePermission') }}</p>
                                        <div class="bg-light p-4 d-block mt-4">
                                            <form action="{{ route('permission.save') }}" method="post" autocomplete="off">
                                                @csrf
                                                <label for="roleSelect">{{ __('nav.selectUserRole') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="role" id="roleSelect"
                                                    class="ui search dropdown d-block w-100 mb-3">
                                                    <option value="">{{ __('nav.selectUserRole') }}</option>
                                                    @php
                                                        $role = DB::table('user_roles')
                                                            ->where('delete_status', 1)
                                                            ->where('role_name', '!=', 'Admin')
                                                            ->orderBy('id', 'desc')
                                                            ->get();
                                                        $incre = 1;
                                                    @endphp
                                                    @foreach ($role as $r)
                                                        <option value="{{ $r->id }}">{{ $r->role_name }}</option>
                                                    @endforeach
                                                </select>

                                                <label for="">{{ __('nav.selectFunction') }}</label>
                                                <div class="table-responsive" id="tableFunction">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('nav.mainFunction') }}</th>
                                                                <th>{{ __('nav.subFunction') }}</th>
                                                                {{-- <th>Actions</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $function = DB::table('main_function')
                                                                    // ->rightJoin('sub_function', 'main_function.id', '=', 'sub_function.main_function_id')
                                                                    ->get();
                                                            @endphp
                                                            @foreach ($function as $f)
                                                                @if ($f->name == 'Dashboard')
                                                                    <tr>
                                                                        <td><input type="checkbox" name="main_function[]"
                                                                                id="mainFunction{{ $f->id }}"
                                                                                value="{{ $f->id }}"> <label
                                                                                for="mainFunction{{ $f->id }}"
                                                                                class="ms-1"><span
                                                                                    class="mdi {{ $f->icon_name }} text-secondary fs-5"></span>
                                                                                @if (session('localization') == 'en')
                                                                                    {{ $f->name }}
                                                                                @else
                                                                                    {{ $f->name_kh }}
                                                                                @endif
                                                                            </label></td>
                                                                        <td></td>
                                                                        {{-- <td></td> --}}
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td><input type="checkbox" name="main_function[]"
                                                                                id="mainFunction{{ $f->id }}"
                                                                                value="{{ $f->id }}"> <label
                                                                                for="mainFunction{{ $f->id }}"
                                                                                class="ms-1"><span
                                                                                    class="mdi {{ $f->icon_name }} text-secondary fs-5"></span>
                                                                                @if (session('localization') == 'en')
                                                                                    {{ $f->name }}
                                                                                @else
                                                                                    {{ $f->name_kh }}
                                                                                @endif
                                                                            </label></td>

                                                                        @php
                                                                            $subFunction = DB::table('sub_function')
                                                                                ->where('main_function_id', $f->id)
                                                                                ->get();

                                                                            $subForUser = DB::table(
                                                                                'user_roles',
                                                                            )->get();
                                                                        @endphp
                                                                        @if ($f->name == 'Manage Users')
                                                                            <td>
                                                                                @foreach ($subFunction as $subF)
                                                                                    <div>
                                                                                        <input type="checkbox"
                                                                                            name="sub_function[]"
                                                                                            id="subFunction{{ $subF->id }}"
                                                                                            value="{{ $subF->id }}">
                                                                                        <label
                                                                                            for="subFunction{{ $subF->id }}"
                                                                                            class="ms-1">
                                                                                            {{ $subF->name }}
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </td>
                                                                        @else
                                                                            <td>
                                                                                @foreach ($subFunction as $subF)
                                                                                    <div>
                                                                                        <input type="checkbox"
                                                                                            name="sub_function[]"
                                                                                            id="subFunction{{ $subF->id }}"
                                                                                            value="{{ $subF->id }}">
                                                                                        <label
                                                                                            for="subFunction{{ $subF->id }}"
                                                                                            class="ms-1">
                                                                                            @if (session('localization') == 'en')
                                                                                                {{ $subF->name }}
                                                                                            @else
                                                                                                {{ $subF->name_kh }}
                                                                                            @endif
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                            </td>
                                                                        @endif
                                                                    </tr>
                                                                @endif
                                                            @endforeach

                                                            <tr>
                                                                <td class="fw-bold">
                                                                    {{ __('nav.allFunctionAction') }}
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="checkbox" name="greenAction"
                                                                            id="edit{{ $f->id }}" value="1">
                                                                        <label for="edit{{ $f->id }}"
                                                                            class="ms-1 text-success">
                                                                            {{ __('nav.greenAction') }} </label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="checkbox" name="redAction"
                                                                            id="delete{{ $f->id }}" value="1">
                                                                        <label for="delete{{ $f->id }}"
                                                                            class="ms-1 text-danger">
                                                                            {{ __('nav.redAction') }} </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="submit"
                                                    class="ui button tiny  d-block ms-auto mt-4 green text-end">
                                                    <span class="mdi mdi-account-check icon"></span>
                                                    {{ __('nav.applyRole') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
                        <div class="row mb-4 justify-content-start d-flex">
                            <div class="col-sm-5 col-dm-2 col-l-2 text-start">
                                <small>&nbsp</small>
                            </div>
                        </div>
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="fw-bold fs-5">{{ __('nav.switchRole') }}</p>
                                        <div class="bg-light p-4 d-block mt-4">
                                            <form action="{{ route('permission.switch') }}" method="post"
                                                autocomplete="off">
                                                @csrf
                                                <label for="user">{{ __('nav.selectuser') }} <span
                                                        class="text-danger">*</span></label>
                                                <select name="user" id="userSelect"
                                                    class="ui search dropdown1 d-block w-100" data-live-search="true">
                                                    <option value="">{{ __('nav.selectuser') }}</option>
                                                    @php
                                                        $user = DB::table('users')
                                                            ->where('role_id', '!=', 'staff')
                                                            ->orderBy('name_en', 'asc')
                                                            ->get();
                                                        $auto = 1;
                                                    @endphp
                                                    @foreach ($user as $u)
                                                        <option
                                                            class =
                                                        "{{ $u->block_status == 0 ? 'text-danger' : '' }}"
                                                            value="{{ $u->id }}">{{ $u->name_en }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="role" class="mt-3">{{ __('nav.selectRole') }}</label>
                                                <select name="role" id="roleSwitch"
                                                    class="ui search dropdown2 d-block w-100">
                                                    <option value="">{{ __('nav.selectRole') }}</option>
                                                    @php
                                                        $roleQry = DB::table('user_roles')->get();
                                                        $auto = 1;
                                                    @endphp
                                                    @foreach ($roleQry as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <button type="submit"
                                                    class="ui button tiny  d-block ms-auto mt-4 green text-end">
                                                    <span class="mdi mdi-account-convert icon"></span>
                                                    {{ __('nav.applySwitch') }}</button>
                                            </form>
                                        </div>
                                    </div>
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
    <script>
        $(document).ready(function() {
            $('#role').addClass('nav-item active');
            $('#icons').addClass('collapse show');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#roleSelect').change(function() {
                var roleID = $(this).val();
                if (roleID) {
                    $.ajax({
                        url: '/get-data/' + roleID,
                        type: 'get',
                        dataType: 'json',
                        // dataType: {rolId: rolId},
                        success: function(data) {
                            //$('#tableFunction').html('<p>' + data.description + '</p>'); // Customize as needed
                            $('#tableFunction').html(data); // Customize as needed
                            // alert('True' + roleID);
                        },
                        error: function(html) {
                            // alert('Hello'+ roleID);
                            $('#tableFunction').html(html);
                        }
                    });
                }
            });

            $('#userSelect').change(function() {
                var userSelect = $(this).val();
                if (userSelect) {
                    $.ajax({
                        url: '/role/' + userSelect,
                        type: 'get',
                        success: function(data) {
                            $('#roleSwitch').html(data); // Customize as needed
                        },
                        error: function(html) {
                            $('#roleSwitch').html(html);
                        }
                    });
                }
            });
        });
    </script>
@endsection
