<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class SectionExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $section = DB::table('section')
            ->select('section.*', 'departments.dep_name_kh', 'departments.dep_name_en')
            ->join('departments', 'section.department_id', '=', 'departments.id')
            ->where('section.delete_status', 1)
            ->orderBy('departments.id', 'asc');
        return view('export.section', ['sections'=>$section->get(), 'title'=> __("nav.section")]);
    }
}
