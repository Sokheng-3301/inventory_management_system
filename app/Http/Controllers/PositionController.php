<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PositionExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    //
    // Login Authentication
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data = DB::table('positions')
            ->select(
                'positions.id',
                'positions.position_name',
                'positions.department_id',
                'positions.add_by',
                'positions.create_date',
                'positions.delete_status',
                'positions.delete_by',
                'positions.delete_date',
                'departments.dep_name_kh',
                'departments.dep_name_en',
                'section.section_en',
                'section.section_kh',
                'section.id as sectionId'
            )
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'section.department_id', '=', 'departments.id')
            ->orderBy('positions.delete_status', 'desc')
            ->orderBy('positions.id', 'desc')
            ->get();

        // ->join('departments', function (JoinClause $join){
        //     $join -> on('departments.department_id', '=', 'positions.department_id');
        // })
        // ->get();
        // dd($data);
        $section = DB::table('section')
            ->where('delete_status', '=', 1)
            ->orderBy('id', 'desc')
            ->get();

        $action = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        // session(['ADMIN' => 'Admin']);

        return view('position.list', ['position' => $data, 'section' => $section, 'action' => $action]);
    }
    public function create(Request $position)
    {
        $validate = Validator::make($position->all(), [
            'positionName' => 'required',
            'section' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $addBy = @Auth::user()->name_en;
        $posName = $position->get('positionName');
        $sectionId = $position->section;

        DB::table('positions')
            ->insert(['position_name' => $posName, 'section_id' => $sectionId, 'add_by' => $addBy]);
        return redirect()->back()->with('success', 'Create position has successfully.');
    }
    public function edit($id)
    {

        $checkRole = DB::table('user_roles')
            ->where('id', @Auth::user()->role_id)
            ->get()->first();
        $action = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();


        if (($checkRole->role_name == 'admin' || $checkRole->role_name == 'Admin') || $action->action_edit == 1) {
            $data = DB::table('positions')
                ->where('positions.id', $id)
                ->orderBy('positions.delete_status', 'desc')
                ->orderBy('positions.id', 'desc')
                ->get()->first();
            if (!$data) {
                return redirect()->route('position.list');
            }
            // dd($data);
            $section = DB::table('section')
                ->where('delete_status', '=', 1)
                ->orderBy('id', 'desc')
                ->get();

            $action = DB::table('apply_funcion_for_role')
                ->where('role_id', @Auth::user()->role_id)
                ->get()->first();

            return view('position.edit', ['section' => $section, 'action' => $action, 'item' => $data]);
        } else {
            return redirect()->back();
        }
    }
    public function update(Request $position)
    {
        $validate = Validator::make($position->all(), [
            'posId' => 'required',
            'positionName' => 'required',
            'section' => 'required',
        ]);
        if($validate->fails()) {
            return redirect()->back()->with('error', 'Fields are required.');
        }
        $posId = $position->posId;
        $posName = $position->get('positionName');
        $sectionId = $position->section;

        DB::table('positions')
            ->where('id', '=', $posId)
            ->update(['position_name' => $posName, 'section_id' => $sectionId]);
        return redirect()->route('position.list')->with('success', 'Update position has successfully.');
    }

    public function delete(Request $position)
    {
        $posId = $position->posId;
        $deleteBy = @Auth::user()->name_en;

        DB::table('positions')
            ->where('id', '=', $posId)
            ->update(['delete_status' => '0', 'delete_date' => now(), 'delete_by' => $deleteBy]);
        return redirect()->back()->with('success', 'Delete position has successfully.');
    }

    public function recovery(Request $position)
    {
        $posId = $position->posId;

        DB::table('positions')
            ->where('id', '=', $posId)
            ->update(['delete_status' => '1', 'delete_date' => NULL, 'delete_by' => NULL]);
        return redirect()->back()->with('success', 'Restore position has successfully.');
    }


    public function export()
    {
        return Excel::download(new PositionExport, 'position-' . now()->format('d-m-Y__h-i-s') . '.xlsx');
    }

    public function exportPdf()
    {
        $data = DB::table('positions')
            ->select(
                'positions.id',
                'positions.position_name',
                'positions.department_id',
                'positions.add_by',
                'positions.create_date',
                'positions.delete_status',
                'positions.delete_by',
                'positions.delete_date',
                'departments.dep_name_kh',
                'departments.dep_name_en',
                'section.section_en',
                'section.section_kh',
                'section.id as sectionId'
            )
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'section.department_id', '=', 'departments.id')
            ->where('positions.delete_status', 1)
            ->orderBy('positions.id', 'desc')->get();

        $html = view('pdf.position', ['positions' => $data, 'title' => __("nav.position")])->render();
        return PdfKh::loadHtml($html)->download('position-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
