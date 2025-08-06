<?php

namespace App\Http\Controllers;

use App\Exports\StaffListExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['user'] = DB::table('users')
            ->select(
                'users.*',
                'positions.position_name',
                'departments.dep_name_kh',
                'departments.dep_name_en',
                // 'user_roles.role_name',
                'section.section_kh',
                'section.section_en',
                'section.department_id'
            )
            // ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
            ->join('positions', 'users.position', 'positions.id')
            ->join('section', 'section.id', 'positions.section_id')
            ->join('departments', 'section.department_id', 'departments.id')

            ->where('users.role_id', '=', 'staff')
            // ->orderBy('departments.dep_name_en', 'asc')
            // ->orderBy('departments.dep_name_kh', 'asc')
            ->orderBy('users.id', 'desc')
            ->get();
        // foreach($data['user'] as $item){
        //     print_r($item);
        // }
        // exit;
        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        return view('staff.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        $data['position'] = DB::table('positions')
            ->select('positions.*', 'positions.id as post_id', 'section.*', 'departments.*')

            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'section.department_id', '=', 'departments.id')
            ->where('positions.delete_status', 1)
            ->orderBy('positions.position_name', 'asc')
            ->get();

        return view('staff.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cardId' => 'nullable|unique:users,card_id',
            'name_kh' => 'required|string',
            'name_en' => 'required|string',
            'gender' => 'required|string',
            'position' => 'required|string',
            'phoneNumber' => 'nullable',
            // 'email' => 'nullable',
        ]);

        $profile = '';
        $name_kh = $request->name_kh;
        $name_en = $request->name_en;


        $cardId = $request->cardId;
        $username = $request->username;
        $password = $request->password;
        $confirmPass = $request->confirmPassword;
        $roleId = $request->roleId;

        $gender = $request->gender;
        $position = $request->position;
        $roleId = $request->roleId;
        $phoneNum = $request->phoneNumber;
        // $emailAddress = $request->email;


        if ($request->file('proImage') == '') {
            $profile = '';
        } else {
            $profile = $request->file('proImage')->store('uploads/users', 'custom');
        }

        $users = DB::table('users')
            ->insert([
                'profile' => $profile,
                'card_id' => $cardId,
                'name_kh' => $name_kh,
                'name_en' => $name_en,
                'role_id' => 'staff',
                'created_at' => now(),
                'create_by' => @Auth::user()->name_en,
                'gender' => $gender,
                'position' => $position,
                'phone_number' => $phoneNum,
                // 'email_address' => $emailAddress,
            ]);
        if ($users == true) {
            return redirect()->back()->with('success', 'Create new staff has successfully.');
        } else {
            return redirect()->back()->with('error', 'Create new staff has failed.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staffqry = DB::table('users')
            ->select(
                'users.*',
                'positions.position_name',
                'departments.dep_name_kh',
                'departments.dep_name_en',
                // 'user_roles.role_name',
                'section.section_kh',
                'section.section_en',
                'section.department_id'
            )
            // ->join('user_roles', 'users.role_id', '=', 'user_roles.id')
            ->join('positions', 'users.position', 'positions.id')
            ->join('section', 'section.id', 'positions.section_id')
            ->join('departments', 'section.department_id', 'departments.id')
            ->where('users.id', $id)
            // ->orderBy('departments.dep_name_en', 'asc')
            // ->orderBy('departments.dep_name_kh', 'asc')
            ->orderBy('users.id', 'desc')
            ->get()->first();
        if(session('localization') == 'kh'){
            $department = $staffqry->dep_name_kh;
            $section = $staffqry->section_kh;
        }else{
            $department = $staffqry->dep_name_en;
            $section = $staffqry->section_en;
        }
        $gender = __('nav.'. strtolower($staffqry->gender));
        $card_id = $staffqry->card_id ?? __("nav.newStaff");
        $created_at = Carbon::parse($staffqry->created_at)->format('d M Y h:i:s A');
        return response()->json([
            'message' => true,
            'department' => $department,
            'section' => $section,
            'gender' => $gender,
            'data' => $staffqry,
            'created_at' => $created_at,
            'card_id' => $card_id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd("Hello world");
        $check = DB::table('users')->where('id', $id)->first();
        if (!$check) {
            // dd("Not check");
            return redirect()->back();
        }

        $data['update'] = true;
        $data['item'] = $check;
        $data['position'] = DB::table('positions')
            ->select('positions.*', 'positions.id as post_id', 'section.*', 'departments.*')

            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'section.department_id', '=', 'departments.id')
            ->where('positions.delete_status', 1)
            ->orderBy('positions.position_name', 'asc')
            ->get();

        return view('staff.add', $data);
        // dd($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $check = DB::table('users')->where('id', $id)->first();
        if (!$check) {
            // dd("Not check");
            return redirect()->back();
        }

        $request->validate([
            'cardId' => 'nullable|unique:users,card_id,' . $id . ',id',
            'name_kh' => 'required|string',
            'name_en' => 'required|string',
            'gender' => 'required|string',
            'position' => 'required|string',
            'phoneNumber' => 'nullable',
            // 'email' => 'nullable',
        ]);

        $profile = '';
        $name_kh = $request->name_kh;
        $name_en = $request->name_en;


        $cardId = $request->cardId;
        $username = $request->username;
        $password = $request->password;
        $confirmPass = $request->confirmPassword;
        $roleId = $request->roleId;

        $gender = $request->gender;
        $position = $request->position;
        $roleId = $request->roleId;
        $phoneNum = $request->phoneNumber;
        // $emailAddress = $request->email;


        if ($request->file('proImage') == '') {
            $profile = $check->profile;
        } else {
            if (File::exists($check->profile)) {
                File::delete($check->profile);
            }
            $profile = $request->file('proImage')->store('uploads/users', 'custom');
        }

        $users = DB::table('users')
            ->where('id', $id)
            ->update([
                'profile' => $profile,
                'card_id' => $cardId,
                'name_kh' => $name_kh,
                'name_en' => $name_en,
                'role_id' => 'staff',
                'updated_at' => now(),
                'gender' => $gender,
                'position' => $position,
                'phone_number' => $phoneNum,
                // 'email_address' => $emailAddress
            ]);
        if ($users == true) {
            return redirect()->route('staff.index')->with('success', 'Update staff info has successfully.');
        } else {
            return redirect()->back()->with('error', 'Update staff info has failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function export()
    {
        return Excel::download(new StaffListExport, 'staff-list-' . now()->format('d-m-Y__h-i-s') . '.xlsx');
    }

    public function exportPdf()
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
            ->orderBy('users.id', 'desc')->get();

        $html = view('pdf.staff-list', ['staffs' => $data, 'title' => __("nav.staffList")])->render();
        return PdfKh::loadHtml($html)->download('staff-list-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
