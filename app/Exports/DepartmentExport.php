<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class DepartmentExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $department = DB::table('departments')
            ->where('delete_status', 1)
            ->orderBy('id', 'desc');
        return view('export.department', ['departments'=>$department->get(), 'title'=>__("nav.department")]);
    }
}
