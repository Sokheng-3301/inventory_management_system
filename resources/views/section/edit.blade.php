@extends('layout/master')

@section('title')
    <title>{{ __('nav.editSection') }} | IMS</title>
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
                        <h3 class="font-weight-bold">{{ __('nav.editSection') }}</h3>
                        <h6 class="font-weight-normal mb-0"> {{ __('nav.master') }} / <span class="text-primary"><a
                                    class="text-primary" href="{{ route('section.list') }}">{{ __('nav.section') }}</a></span>
                        </h6>
                    </div>
                    {{-- <div class="col-12 col-xl-4">
                    <div class="justify-content-end d-flex">
                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                <a class="dropdown-item" href="#">January - March</a>
                                <a class="dropdown-item" href="#">March - June</a>
                                <a class="dropdown-item" href="#">June - August</a>
                                <a class="dropdown-item" href="#">August - November</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                </div>
                <div class="row mt-4">
                    <div class="col-md-7">
                        @include('layout.back-button')
                        @php

                            $checkRole = DB::table('user_roles')
                                ->where('id', @Auth::user()->role_id)
                                ->get()
                                ->first();
                        @endphp
                        <div class="card p-2">
                            <div class="card-body">
                                <form action="{{ route('section.update') }}" method="post" autocomplete="off"
                                    class="ui form">
                                    <div class="modal-body">
                                        @csrf
                                        <input type="hidden" class="d-none" style="display: none;" name="section_id"
                                            value="{{ $item->id }}">
                                        <div class="field">
                                            <label for="departmentCode">{{ __('nav.sectionKh') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="departmentCode"
                                                name="sectionKh" placeholder="{{ __('nav.sectionKh') }}"
                                                value="{{ $item->section_kh }}">
                                        </div>

                                        <div class="field">
                                            <label for="departmentNameKh"> {{ __('nav.sectionEn') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="departmentNameKh"
                                                name="sectionEn" placeholder="{{ __('nav.sectionEn') }}"
                                                value="{{ $item->section_en }}">
                                        </div>

                                        <div class="field">
                                            <label for="departmentNameEn"> {{ __('nav.department') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="department_id" id="department" class="ui fluid search dropdown">
                                                <option value="">{{ __('nav.department') }}</option>
                                                @php
                                                    $auto = 1;
                                                @endphp
                                                @foreach ($department as $dep)
                                                    @if (session('localization') == 'en')
                                                        <option {{ $item->department_id == $dep->id ? 'selected' : '' }}
                                                            value="{{ $dep->id }}">{{ $dep->dep_name_en }}</option>
                                                    @else
                                                        <option {{ $item->department_id == $dep->id ? 'selected' : '' }}
                                                            value="{{ $dep->id }}">{{ $dep->dep_name_kh }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="firld text-end">
                                            <a href="{{ route('section.list') }}" class="ui button tiny grey">
                                                <i class="ui x icon"></i>{{ __('nav.cancel') }}
                                            </a>
                                            <button type="submit" class="ui button tiny green">
                                                <span class="mdi mdi-check-circle icon"></span> {{ __('nav.update') }}
                                            </button>
                                        </div>

                                    </div>


                                </form>

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
            $('#master').addClass('nav-item active');
            $('#ui-basic').addClass('collapse show');
        });

        $('.ui.form')
            .form({
                fields: {
                    sectionKh: {
                        identifier: 'sectionKh',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                    sectionEn: {
                        identifier: 'sectionEn',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    },
                    department_id: {
                        identifier: 'department_id',
                        rules: [{
                            type: 'empty',
                            prompt: 'Please enter your name'
                        }]
                    }
                }
            });
    </script>
@endsection
