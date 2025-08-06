<?php

namespace App\Http\Controllers;

use App\Exports\DepartmentExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

class DepartmentController extends Controller
{
    //
    // Login Authentication
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
        $data['department'] = DB::table('departments')
                ->orderBy('id', 'desc')
                ->orderBy('delete_status', 'desc')
                ->get();

        // session(['ADMIN' => 'Admin']);


        $data['action'] = DB::table('apply_funcion_for_role')
                            ->where('role_id', @Auth::user()->role_id)
                            ->get()->first();

        return view('department.list', $data);
    }
    public function create(Request $department){

        $validate = Validator::make($department->all(), [
            'departmentCode' => 'nullable|string|max:10|unique:departments,department_code',
            'departmentNameKh' => 'required',
            'departmentNameEn' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $addBy = @Auth::user()->name_en;
        $depCode = $department->get('departmentCode');
        $depNameKh = $department->departmentNameKh;
        $depNameEn = $department->departmentNameEn;

        DB::table('departments')
            ->insert(['department_code' => $depCode, 'dep_name_kh' => $depNameKh, 'dep_name_en' => $depNameEn,
            'add_by' => $addBy, 'year' => date('Y')]);
        return redirect()->back()->with('success', 'Create department has successfully.');
    }

    public function getData(string $id){
        $department = DB::table('departments')
            ->where('id', $id)
            ->first();

        if ($department) {
            return response()->json([
                'status' => 'success',
                'data' => $department
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found.'
            ], 404);
        }
    }

    public function update(Request $department, string $id){
        // dd('Update method called with ID: ' . $id);
        $validate = Validator::make($department->all(), [
            'departmentCode' => 'nullable|string|max:10|unique:departments,department_code,'. $id . ',id',
            'departmentNameKh' => 'required',
            'departmentNameEn' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', __('nav.codeUnique'));
        }
        $depCode = $department->get('departmentCode');
        $depNameKh = $department->departmentNameKh;
        $depNameEn = $department->departmentNameEn;

        DB::table('departments')
            ->where('id', '=', $id)
            ->update(['department_code' => $depCode, 'dep_name_kh' => $depNameKh, 'dep_name_en' => $depNameEn]);
        return redirect()->back()->with('success', 'Update department has successfully.');
    }

    public function delete(Request $department){
        $depId = $department->depId;
        $deleteBy = @Auth::user()->name_en;

        DB::table('departments')
                ->where('id', '=', $depId)
                ->update(['delete_status' => '0', 'delete_date' => now(), 'delete_by' => $deleteBy]);
            return redirect()->back()->with('success', 'Delete department has successfully.');
    }

    public function recovery(Request $department){
        $depId = $department->depId;
        DB::table('departments')
                ->where('id', '=', $depId)
                ->update(['delete_status' => '1', 'delete_date' => NULL, 'delete_by' => NULL]);
            return redirect()->back()->with('success', 'Restore department has successfully.');
    }

    public function export(){
        return Excel::download(new DepartmentExport, 'department-'. now()->format('d-m-Y__h-i-s') . '.xlsx');
    }

    public function exportPdf(){
       $department = DB::table('departments')
            ->where('delete_status', 1)
            ->orderBy('id', 'desc')->get();

        $html = view('pdf.department', ['departments' => $department,'title' => __("nav.department")])->render();
        return PdfKh::loadHtml($html)->download('department-'. now()->format('d-m-Y__h-i-s') .'.pdf');
    }
}
