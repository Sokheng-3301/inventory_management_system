@extends('layout/master')

@section('title')
    <title> {{ __('nav.productOutstock') }} | IMS</title>
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

        .attchLabel {
            width: 100%;
            display: block;
        }

        .attch {
            width: 100%;
            height: auto;
            /* display: flex; */
            align-items: center;
            text-align: center;
            cursor: pointer;
            display: block;
            border: 1.8px dashed #d0d4d9;
            padding: 10px;
            border-radius: 5px;
        }

        .attch img.icon {
            width: 15%;
        }

        .attch img {
            width: 100%
        }

        .attachmentFile {
            display: none;
        }

        .give-btn:hover {
            background-color: #45942b;
            box-shadow: 1px 1px 6px rgb(88, 88, 88);
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">{{ __('nav.productOutstock') }} </h3>
                        <h6 class="font-weight-normal mb-0">{{ __('nav.product') }} / <span class="text-primary"><a
                                    class="text-primary" href="">{{ __('nav.productOutstock') }} </a></span></h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 col-md-12 col-l-12 col-xl-12">
                        @include('layout.back-button')
                        <div class="card p-2">
                            <div class="card-body">
                                <div class="row d-flex align-items-center mb-3">


                                    @php
                                        $checkRole = DB::table('user_roles')
                                            ->where('id', @Auth::user()->role_id)
                                            ->get()
                                            ->first();
                                    @endphp

                                    @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)

                                        <div class="col-8 col-sm-7 mb-2  col-md-7">
                                            <div class="ui small icon buttons">
                                                <button class="ui button fw-normal" title="print" id="printButton"><i
                                                        class="print icon"></i>Print</button>
                                                <a href="{{ route('product.exportOutstock') }}" class="ui button fw-normal"
                                                    title="Excel"><i class="file excel icon"></i>Excel</a>
                                                <a href="{{ route('product.exportOutstockPdf') }}"
                                                    class="ui button fw-normal" title=  "PDF"><i
                                                        class="file pdf icon"></i>PDF</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="table-responsive">
                                    <table id="myTable" class="display table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px;" class="text-start">{{ __('home.no') }}</th>
                                                <th>{{ __('nav.img') }}</th>
                                                <th> {{ __('nav.proCode') }} </th>
                                                <th> {{ __('nav.proName') }}</th>
                                                <th>{{ __('nav.model') }}</th>
                                                <th>{{ __('nav.serial_number') }}</th>
                                                <th>{{ __('nav.fix_asset_code') }}</th>
                                                <th> {{ __('nav.category') }}</th>
                                                <th> {{ __('nav.equipment_type') }}</th>
                                                <th colspan="2">{{ __('nav.status') }}</th>
                                                <th> {{ __('nav.createAt') }} </th>
                                                <th> {{ __('nav.actions') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $auto = 1;
                                            @endphp
                                            @foreach ($product as $item)
                                                <tr>
                                                    <td style="width: 10px" class="text-start <?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ $auto++ }}
                                                    </td>
                                                    <td>
                                                        @if ($item->pro_img == '')
                                                            <img src="{{ asset('images/draft-image.png') }}"
                                                                alt="">
                                                        @else
                                                            <img src="{{ asset($item->pro_img) }}" alt="">
                                                        @endif
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->pro_code }}
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->pro_name_en }}
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->model }}
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->serial_number }}
                                                    </td>
                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">{{ $item->fix_asset_code }}
                                                    </td>

                                                    <td class="<?php
                                                        if ($item->delete_status == '0') {
                                                            echo 'text-danger';
                                                        }
                                                        ?>">{{ $item->cat_name }}
                                                    </td>

                                                    <td class="{{ $item->delete_status == '0' ? 'text-danger' : '' }}">
                                                        @if ($item->equipment_type == 1)
                                                            <span class="text-danger">{{__("nav.equipment")}}</span>
                                                        @elseif($item->equipment_type == 2)
                                                            <span class="text-primary">{{__("nav.accessories")}}</span>
                                                        @else

                                                        @endif
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        @if ($item->qty == '0')

                                                            <div class="ui red label">
                                                                {{ __('nav.Outstock') }}
                                                            </div>
                                                        @else
                                                                {{ __('nav.Instock') }}

                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                    </td>

                                                    <td class="<?php
                                                    if ($item->delete_status == '0') {
                                                        echo 'text-danger';
                                                    }
                                                    ?>">
                                                        {{ Carbon\Carbon::parse($item->create_date)->format('d M Y') }}
                                                    </td>

                                                    <td>
                                                        <a type="button" data-id="{{ $item->id }}"
                                                            id="detailButton"><span
                                                                class="mdi mdi-eye-outline fs-5 text-primary"
                                                                title="View detail"></span></a>

                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_edit == 1)
                                                            | <a href="{{ route('product.edit', $item->id) }}"><span
                                                                    class="mdi mdi-square-edit-outline fs-5 text-primary"
                                                                    title="Update data"></span></a>
                                                        @endif

                                                        @if ($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin' || $action->action_delete == 1)
                                                            @include('layout.action-master-layout')
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <!-- Add more rows as needed -->
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

    <!-- Modal detail-->
    <div class="modal fade" id="productDetail">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateForm{{ $item->id }}"><span
                            class="mdi mdi-book-open"></span>
                        {{ __('nav.proDetail') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 ">
                            <div class="bg-light p-3">
                                <p class="fw-bold text-center text-primary"> {{ __('nav.proImg') }} </p>
                                <label for="productImg" id="proImg">
                                    <span class="mdi mdi-image"></span>
                                    <img src="" id="file-input" alt="">
                                </label>
                                <small class="text-center d-block"> {{ __('nav.proImg') }}.</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="bg-light p-3">
                                <p class="fw-bold text-center text-primary">{{ __('nav.proInfo') }}</p>
                                <div class="row d-flex align-items-center ">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="" class="fw-bold">{{ __('nav.proCode') }} </label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="pro_code"></p>
                                    </div>

                                </div>
                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="proNameKh" class="fw-bold"> {{ __('nav.proNameKh') }} </label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="pro_name_kh"></p>
                                    </div>
                                </div>

                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="proNameEn" class="fw-bold"> {{ __('nav.proNameEn') }} </label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="pro_name_en"></p>
                                    </div>
                                </div>


                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="model" class="fw-bold"> {{ __('nav.model') }} </label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="model"></p>
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="serial_number" class="fw-bold"> {{ __('nav.serial_number') }}
                                        </label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="serial_number"></p>
                                    </div>
                                </div>

                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="fix_asset_code" class="fw-bold"> {{ __('nav.fix_asset_code') }}
                                        </label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="fix_asset_code"></p>
                                    </div>
                                </div>


                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="proNameEn" class="fw-bold"> {{ __('nav.categoryName') }} </label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="cat_name"></p>
                                    </div>
                                </div>


                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="qty" class="fw-bold"> {{ __('home.qty') }} </label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="qty">
                                            {{-- @if ($item->stock_status == '0')
                                                <small class="badge bg-danger ms-3 d-inline-block">
                                                    {{ __('nav.Outstock') }}
                                                </small>
                                            @else
                                                <small class="badge badge-primary ms-3 d-inline-block">
                                                    {{ __('nav.Instock') }}
                                                </small>
                                            @endif --}}
                                        </p>
                                    </div>
                                </div>

                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        <label for="descript" class="fw-bold"> {{ __('nav.Description') }} <span
                                                class="text-danger"></span></label>
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p id="pro_description"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>

                                <div class="row d-flex align-items-center mt-2">
                                    <div class="col-sm-12 col-md-3 col-l-3">
                                        {{-- <label for="descript" class="fw-bold">Description <span class="text-danger"></span></label> --}}
                                    </div>
                                    <div class="col-sm-12 col-md-9 col-l-9">
                                        <p> {{ __('nav.createAt') }} : <span id="create_date"></span></p>
                                        <p> {{ __('nav.createBy') }} : <span id="add_by"></span></p>

                                        @if ($item->delete_status == 0)
                                            <p class="text-danger"> {{ __('nav.deleteAt') }} : <span
                                                    id="delete_date"></span>
                                            </p>
                                            <p class="text-danger"> {{ __('nav.deleteBy') }} : <span
                                                    id="delete_by"></span>
                                            </p>
                                        @endif
                                    </div>
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
                    <form action="{{ route('product.delete') }}" method="post" autocomplete="off">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="d-none" name="proId" id="deleteProID" value="">

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
                    <form action="{{ route('product.recovery') }}" method="post" autocomplete="off">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" class="d-none" name="proId" id="restoreProID" value="">
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
    @foreach ($product as $item)
        <script>
            document.getElementById('attachment{{ $item->id }}').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('file-attach{{ $item->id }}');
                        const draftImg = document.getElementById('draft-img{{ $item->id }}');
                        preview.src = e.target.result;
                        preview.style.display = 'block'; // Show the image
                        draftImg.style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endforeach

    <script>
        $(document).ready(function() {
            $('#product').addClass('nav-item active');
            $('#form-elements').addClass('collapse show');

            $(document).on('click', '#detailButton', function() {
                $('#productDetail').modal('show');
                var id = $(this).data('id');
                var url = "{{ route('product.showOutstock', ':id') }}".replace(":id", id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        if (response.data.pro_img != '') {
                            $('#file-input').attr('src', '{{ asset('') }}' + response.data
                                .pro_img);
                        }

                        $('#pro_code').text(response.data.pro_code);
                        $('#pro_name_kh').text(response.data.pro_name_kh);
                        $('#pro_name_en').text(response.data.pro_name_en);
                        $('#model').text(response.data.model);
                        $('#serial_number').text(response.data.serial_number);
                        $('#fix_asset_code').text(response.data.fix_asset_code);
                        $('#cat_name').text(response.data.cat_name);
                        $('#qty').text(response.data.qty);
                        $('#pro_description').text(response.data.pro_description);
                        $('#add_by').text(response.data.add_by);
                        $('#create_date').text(response.create_at);
                        $('#proId').val(response.data.id);
                        $('#input_qty').val(response.data.qty);
                        $('#input_qty').attr('max', response.data.qty);
                        $('#label_qty').text(response.data.qty);
                    }
                });
            });
        });
    </script>
@endsection
