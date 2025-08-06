{{-- {{ dd(auth()->user()->id) }} --}}
@php
    $checkPermission = DB::table('apply_funcion_for_role')
        ->where('role_id', @Auth::user()->role_id)
        ->get()
        ->first();
    if ($checkPermission) {
        $subFunction = explode(',', $checkPermission->sub_function_id); // Fixed 'exploade' to 'explode'
        $mainFunction = explode(',', $checkPermission->main_function_id); // Fixed 'exploade' to 'explode'
    } else {
        $subFunction = [];
        $mainFunction = [];
    }
@endphp
<ul class="nav" id="sidebar-menu">
    <li class="nav-item" id="profile_menu">
        <div id="profile_link">
            <img src="{{ @Auth::user()->profile ? asset(@Auth::user()->profile) : asset('images/draft-user.jpg') }}"
                alt="profile" />
            <div class="active_dot"></div>
            <span class="menu-title">
                {{ Auth::user()->gender == 'Male' ? __('nav.Mr') : __('nav.Miss') }}
                {{ session('localization') == 'kh' ? strtoupper(Auth::user()->name_kh) : strtoupper(Auth::user()->name_en) }}
            </span>
        </div>
    </li>
    {{-- <hr class="border border-white"> --}}
    @if (strtolower($checkRole->role_name) == 'admin' || in_array(1, $mainFunction))
        <li class="nav-item" id="home">
            <a class="nav-link" href="/">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">{{ __('nav.dashboard') }}</span>
            </a>
        </li>
    @endif

    @if (strtolower($checkRole->role_name) == 'admin' || in_array(2, $mainFunction))
        <li class="nav-item" id="master">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-database-outline menu-icon"></i>
                <span class="menu-title">{{ __('nav.master') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(1, $subFunction))
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('category.list') }}">{{ __('nav.category') }}</a>
                        </li>
                    @endif

                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(15, $subFunction))
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('item_code.index') }}">{{ __('nav.itemCode') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(2, $subFunction))
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('department.list') }}">{{ __('nav.department') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(3, $subFunction))
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('section.list') }}">{{ __('nav.section') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(4, $subFunction))
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('position.list') }}">{{ __('nav.position') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(5, $subFunction))
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ route('staff.index') }}">{{ __('nav.staffList') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif

    @if (strtolower($checkRole->role_name) == 'admin' || in_array(3, $mainFunction))
        <li class="nav-item" id="product">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="mdi mdi-table menu-icon"></i>
                <span class="menu-title">{{ __('nav.product') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(6, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('product.instock') }}">{{ __('nav.productInStock') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(7, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('product.outstock') }}">{{ __('nav.productOutstock') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(8, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.statistic') }}">{{ __('nav.statistic') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(16, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.trashbin') }}">{{ __('nav.trashbin') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif

    @if (strtolower($checkRole->role_name) == 'admin' || in_array(4, $mainFunction))
        <li class="nav-item" id="givenAndReturned">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                <i class="mdi mdi-hand-coin-outline menu-icon"></i>
                <span class="menu-title">{{ __('nav.givenAndReturned') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(9, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.addGive') }}">{{ __('nav.addNewGive') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(10, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.givenList') }}">{{ __('nav.given') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(11, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.returned') }}">{{ __('nav.returned') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(12, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('returnOutList.index') }}">{{ __('nav.returnOutlist') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif

    @if (strtolower($checkRole->role_name) == 'admin' || in_array(5, $mainFunction))
        <li class="nav-item" id="expenseReportMain">
            <a class="nav-link" data-toggle="collapse" href="#expenseReport" aria-expanded="false"
                aria-controls="expenseReport">
                <i class="mdi mdi-finance menu-icon"></i>
                <span class="menu-title">{{ __('nav.expenseReport') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="expenseReport">
                <ul class="nav flex-column sub-menu">
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(13, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('expense.purchase.index') }}">{{ __('nav.ItePurchase') }}</a>
                        </li>
                    @endif
                    @if (strtolower($checkRole->role_name) == 'admin' || in_array(14, $subFunction))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('expense.service.index') }}">{{ __('nav.serviceFee') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif

    @if (strtolower($checkRole->role_name) == 'admin' || in_array(6, $mainFunction))
        <li class="nav-item" id="inventory_list">
            <a class="nav-link" href="{{ route('reports.index') }}">
                <i class="mdi mdi-chart-bar menu-icon"></i>
                <span class="menu-title">{{ __('nav.report') }}</span>
            </a>
        </li>
    @endif

    @if (strtolower($checkRole->role_name) == 'admin' || in_array(7, $mainFunction))
        <hr class="border border-white">
        <li class="nav-item" id="users">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="mdi mdi-account-group-outline menu-icon"></i>
                <span class="menu-title">
                    {{ __('nav.manageUser') }}
                </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    @php
                        $role = DB::select('select * from user_roles where delete_status = ? ', [1]);
                    @endphp
                    @foreach ($role as $r)
                        @if ($r->role_name == 'Admin' && strtolower($checkRole->role_name) != 'admin')
                        @else
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ url('user/' . $r->id . '/' . $r->role_name) }}">{{ $r->role_name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </li>
    @endif

    @if (strtolower($checkRole->role_name) == 'admin' || strtolower($checkRole->role_name) == 'super-admin')
        <li class="nav-item" id="role">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="mdi mdi-target-account menu-icon"></i>
                <span class="menu-title">{{ __('nav.manageRole') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('role.list') }}">{{ __('nav.Role') }}</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('permission.index') }}">{{ __('nav.userPermission') }}</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item" id="db">
            <a class="nav-link" data-toggle="collapse" href="#export_db" aria-expanded="false"
                aria-controls="export_db">
                <i class="mdi mdi-cloud-upload-outline menu-icon"></i>
                <span class="menu-title">{{ __('nav.backupData') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="export_db">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#dataBackupForm">{{ __('nav.exportData') }}</a>
                    </li>
                </ul>
            </div>
        </li>
    @endif
</ul>
