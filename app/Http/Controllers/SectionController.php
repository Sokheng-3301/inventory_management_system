<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SectionExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    //
    public function index()
    {

        $data['section'] = DB::table('section')
            ->select('section.*', 'departments.dep_name_kh', 'departments.dep_name_en')
            ->join('departments', 'section.department_id', '=', 'departments.id')
            ->orderBy('section.id', 'desc')
            ->get();


        $data['department'] = DB::table('departments')
            ->where('delete_status', 1)
            ->orderBy('id', 'desc')->get();
        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        return view('section.list', $data);
    }

    public function create(Request $r)
    {
        $validate = Validator::make($r->all(), [
            'sectionKh' => 'required',
            'sectionEn' => 'required',
            'department_id' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $sectionKh = $r->get('sectionKh');
        $sectionEn = $r->get('sectionEn');
        $departmentId = $r->department_id;

        $sectionInsert = DB::table('section')
            ->insert([
                'section_kh' => $sectionKh,
                'section_en' => $sectionEn,
                'department_id' => $departmentId,
                'create_by' => @Auth::user()->name_en
            ]);

        if ($sectionInsert == true) {
            return redirect()->back()->with('success', 'Create section has successfully.');
        } else {
            return redirect()->back()->with('error', 'Create section has failed.');
        }
    }

    public function edit(string $id)
    {

        $checkRole = DB::table('user_roles')
            ->where('id', @Auth::user()->role_id)
            ->get()->first();
        $action = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_edit == 1) {
            // Attempt to find the section by ID
            $section = DB::table('section')->find($id);

            if (!$section) {
                return redirect()->back();
            }

            // Retrieve active departments
            $departments = DB::table('departments')
                ->where('delete_status', 1)
                ->orderBy('id', 'desc')->get();

            // Prepare data for the view
            $data = [
                'item' => $section,
                'department' => $departments,
            ];

            return view('section.edit', $data);
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $r)
    {

        $validate = Validator::make($r->all(), [
            'section_id' => 'required',
            'sectionKh' => 'required',
            'sectionEn' => 'required',
            'department_id' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->route('section.list')->with('error', 'Please fill all required fields.');
        }
        // dd($r->input());

        $sectionId = $r->section_id;
        $sectionKh = $r->get('sectionKh');
        $sectionEn = $r->get('sectionEn');
        $departmentId = $r->department_id;

        DB::table('section')
            ->where('id', $sectionId)
            ->update([
                'section_kh' => $sectionKh,
                'section_en' => $sectionEn,
                'department_id' => $departmentId
            ]);
        return redirect()->route('section.list')->with('success', 'Update section has successfully.');
    }

    public function delete(Request $r)
    {
        $sectionId = $r->section_id;
        if ($sectionId != '') {
            $sectionDelete = DB::table('section')
                ->where('id', $sectionId)
                ->update([
                    'delete_status' => 0,
                    'delete_by' => @Auth::user()->name_en,
                    'delete_date' => now()
                ]);
            if ($sectionDelete == true) {
                return redirect()->back()->with('success', 'Delete section has successfully.');
            } else {
                return redirect()->back()->with('error', 'Delete section has failed.');
            }
        } else {
            return redirect()->back()->with('error', 'Delete section has failed.');
        }
    }

    public function recovery(Request $r)
    {
        $sectionId = $r->section_id;
        if ($sectionId != '') {
            $sectionDelete = DB::table('section')
                ->where('id', $sectionId)
                ->update([
                    'delete_status' => 1,
                    'delete_by' => null,
                    'delete_date' => null
                ]);

            if ($sectionDelete == true) {
                return redirect()->back()->with('success', 'Restore section has successfully.');
            } else {
                return redirect()->back()->with('error', 'Restore section has failed.');
            }
        } else {
            return redirect()->back()->with('error', 'Restore section has failed.');
        }
    }

    public function export()
    {
        return Excel::download(new SectionExport, 'section-' . now()->format('d-m-Y__h-i-s') . '.xlsx');
    }

    public function exportPdf()
    {
        $section = DB::table('section')
            ->select('section.*', 'departments.dep_name_kh', 'departments.dep_name_en')
            ->join('departments', 'section.department_id', '=', 'departments.id')
            ->where('section.delete_status', 1)
            ->orderBy('departments.id', 'asc')->get();

        $html = view('pdf.section', ['sections' => $section, 'title' => __("nav.section")])->render();
        return PdfKh::loadHtml($html)->download('section-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
