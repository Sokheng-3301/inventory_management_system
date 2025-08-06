@extends('layout/master')

@section('title')
    <title> {{ __('nav.itemCode') }} | IMS</title>
@endsection

@section('css')
    <style>
        table.dataTable th.dt-type-numeric,
        table.dataTable th.dt-type-date,
        table.dataTable td.dt-type-numeric,
        table.dataTable td.dt-type-date {
            text-align: start;
        }

        #file-input {
            display: block;
            /* width: 100%; */
            height: 100%;
            position: absolute;

        }

        #profileImage {
            width: 50%;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold"> {{ __('nav.itemCode') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.master') }} / <span class="text-primary"><a
                                    class="text-primary" href=""> {{ __('nav.itemCode') }}</a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body">

                                @php
                                    $checkRole = DB::table('user_roles')
                                        ->where('id', @Auth::user()->role_id)
                                        ->get()
                                        ->first();
                                @endphp

                                @if (
                                    $checkRole->role_name == 'admin' ||
                                        $checkRole->role_name == 'Admin' ||
                                        $checkRole->role_name == 'Super Admin' ||
                                        $action->action_edit == 1)
                                    <div class="row">
                                        <div class="col-8 col-sm-7 mb-2  col-md-7">
                                            <div class="ui small icon buttons">
                                                <button class="ui button fw-normal" title="print" id="printButton"><i
                                                        class="print icon"></i>Print</button>
                                                <a href="{{ route('item_code.exportExcel') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('item_code.exportPdf') }}" class="ui button fw-normal"
                                                    title=  "PDF"><i class="file pdf icon"></i>PDF</a>
                                            </div>
                                        </div>

                                        <div class="col-4 col-sm-5 mb-2  col-md-5 text-end">
                                            <a href="{{ route('item_code.create') }}" class="ui button primary tiny"><span
                                                    class="mdi mdi-plus-circle icon"></span> {{ __('nav.addNew') }}
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <table id="myTable" class="display table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px;" class="text-start"> {{ __('home.no') }} </th>
                                                <th> {{ __('nav.itemCode') }} </th>
                                                <th> {{ __('nav.proNameKh') }} </th>
                                                <th> {{ __('nav.proNameEn') }} </th>
                                                <th class="text-start">{{ __('nav.category') }}</th>
                                                <th> {{ __('nav.equipment_type') }}</th>
                                                <th> {{ __('nav.deleteBy') }} </th>
                                                <th class="text-center"> {{ __('nav.actions') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                            @endphp
                                            @foreach ($item_codes as $item)
                                                <tr>
                                                    <td style="width: 10px" class="text-start {{ $item->deleteStatus == 0 ? 'text-danger' : '' }}">{{ $auto++ }}</td>
                                                    <td class="text {{ $item->deleteStatus == 0 ? 'text-danger' : '' }}">{{ $item->item_code }} </td>
                                                    <td class="text {{ $item->deleteStatus == 0 ? 'text-danger' : '' }}">{{ $item->item_name_kh }} </td>
                                                    <td class="text {{ $item->deleteStatus == 0 ? 'text-danger' : '' }}">{{ $item->item_name_en }} </td>
                                                    <td class="text {{ $item->deleteStatus == 0 ? 'text-danger' : '' }}">{{ $item->cat_name }} </td>
                                                    <td class="text {{ $item->deleteStatus == 0 ? 'text-danger' : '' }}">{{ $item->equipment_type == 1 ? __("nav.equipment") : __('nav.accessories') }} </td>
                                                    <td class="text {{ $item->deleteStatus == 0 ? 'text-danger' : '' }}">
                                                        <p>{{ strtoupper($item->deleted_by) }}</p>
                                                        @if ($item->deleted_date)
                                                            <p>{{ Carbon\Carbon::parse($item->deleted_date)->format('d M Y h:i:s A') }}</p>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        {{-- <a type="button" data-id="{{ $item->id }}"
                                                            id="detailButton"><span
                                                                class="mdi mdi-eye-outline fs-5 text-primary"
                                                                title="View detail"></span></a> --}}

                                                        @if (
                                                            $checkRole->role_name == 'admin' ||
                                                                $checkRole->role_name == 'Admin' ||
                                                                $checkRole->role_name == 'Super Admin' ||
                                                                $action->action_edit == 1)
                                                            <a href="{{ route('item_code.edit', $item->item_code_id) }}"><span
                                                                    class="mdi mdi-square-edit-outline fs-5"
                                                                    title="Update data"></span></a>
                                                        @endif

                                                        @if (
                                                            $checkRole->role_name == 'admin' ||
                                                                $checkRole->role_name == 'Admin' ||
                                                                $checkRole->role_name == 'Super Admin' ||
                                                                $action->action_delete == 1)
                                                            |
                                                            @if ($item->deleteStatus == '0')
                                                                <a type="button" id="restoreItemCodeButton"
                                                                    data-id="{{ $item->item_code_id }}"><span
                                                                        class="mdi mdi-backup-restore fw-bold text-success fs-5"
                                                                        title="Recovery data"></span></a>
                                                            @else
                                                                <a type="button" id="deleteItemCodeButton"
                                                                    data-id="{{ $item->item_code_id }}"><span
                                                                        class="mdi mdi-trash-can-outline text-danger fs-5"
                                                                        title="Delete data"></span></a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_delete == 1)
        <!-- Modal Delete-->
        <div class="modal fade" id="deleteVerify">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="" method="post" autocomplete="off" id="formDelete">
                        <div class="modal-body">
                            {{-- @method('DELETE') --}}
                            @csrf
                            {{-- <input name="item_id" id="deleteProID" value=""> --}}
                            <h2 class="ui icon header text-center w-100">
                                <i class="question icon"></i>
                                <div class="content mt-3">
                                    {{ __('nav.deleteData') }}
                                    <div class="sub header mt-2"> {{ __('nav.doYouWantToDelete') }} </div>
                                </div>
                            </h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="ui button tiny" data-bs-dismiss="modal"><span
                                    class="mdi mdi-close icon"></span>{{ __('nav.cancel') }}</button>
                            <button type="submit" class="ui button tiny red">
                                <span class="mdi mdi-trash-can-outline icon"></span>
                                {{ __('nav.yesDelete') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal recovery-->
        <div class="modal fade" id="restoreModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="" method="post" autocomplete="off" id="restoreForm">
                        <div class="modal-body">
                            @csrf
                            {{-- <input type="hidden" class="d-none" name="item_id" id="restoreProID" value=""> --}}
                            <h2 class="ui icon header text-center w-100">
                                <i class="question icon"></i>
                                <div class="content mt-3">
                                    {{ __('nav.restoreData') }}
                                    <div class="sub header mt-2"> {{ __('nav.doYouWantToRestore') }} </div>
                                </div>
                            </h2>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="ui button tiny" data-bs-dismiss="modal"><span
                                    class="mdi mdi-close icon"></span>{{ __('nav.cancel') }}</button>
                            <button type="submit" class="ui button tiny blue">
                                <span class="mdi mdi-trash-restore icon"></span>
                                {{ __('nav.yesRestore') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#master').addClass('nav-item active');
            $('#ui-basic').addClass('collapse show');

            // $(document).on('click', '#detailButton', function() {
            //     var id = $(this).data('id');
            //     var url = "{{ route('staff.show', ':id') }}".replace(':id', id);
            //     $.ajax({
            //         type: "GET",
            //         url: url,
            //         dataType: "json",
            //         success: function(response) {
            //             $('#staffInfoModal').modal('show');
            //             $('#profileImage').attr('src', response.data.profile ?
            //                 "{{ asset('') }}" + response.data.profile :
            //                 "{{ asset('images/draft-user.jpg') }}");
            //             $('#card_id').text(response.card_id);
            //             $('#name_kh').text(response.data.name_kh);
            //             $('#name_en').text(response.data.name_en);
            //             $('#gender').text(response.gender);
            //             $('#department').text(response.department);
            //             $('#position').text(response.data.position_name);
            //             $('#section').text(response.section);
            //             $('#phone_number').text(response.data.phone_number);
            //             $('#email_address').text(response.data.email_address ? response.data
            //                 .email_address : 'N/A'); // Fixed here
            //             $('#created_at').text(response.created_at);
            //             $('#create_by').text(response.data.create_by);




            //         }
            //     });
            // });

            $(document).on('click', '#deleteItemCodeButton', function () {
                var id = $(this).data('id');
                var url = "{{ route('item_code.delete', ':id') }}".replace(':id', id);

                $('#deleteVerify').modal('show');
                $('#formDelete').attr('action', url);
            });

            $(document).on('click', '#restoreItemCodeButton', function () {
                var id = $(this).data('id');
                var url = "{{ route('item_code.delete', ':id') }}".replace(':id', id);

                $('#restoreModal').modal('show');
                $('#restoreForm').attr('action', url);
            });
        });
    </script>
@endsection
