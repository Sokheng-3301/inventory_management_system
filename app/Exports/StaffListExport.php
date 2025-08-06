<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class StaffListExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = DB::table('users')
            ->select(
                'users.*',
                'positions.position_name',
                'departments.dep_name_kh',
                'departments.dep_name_en',
                'section.section_kh',
                'section.section_en',
                'section.department_id'
            )
            ->join('positions', 'users.position', 'positions.id')
            ->join('section', 'section.id', 'positions.section_id')
            ->join('departments', 'section.department_id', 'departments.id')
            ->where('users.role_id', '=', 'staff')
            ->orderBy('users.id', 'desc');
        return view('export.staff-list', ['staffs'=>$data->get(), 'title' => __("nav.staffList")]);
    }
}
