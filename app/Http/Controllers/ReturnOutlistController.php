<?php

namespace App\Http\Controllers;

use App\Exports\ReturnOulistExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use Illuminate\Support\Facades\Validator;

class ReturnOutlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['product'] = DB::table('return_outlists')
            ->select(
                'return_outlists.*',
                'return_outlists.id as returned_id',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*',
                'item_codes.*'
            )
            ->join('users', 'return_outlists.staff_id', 'users.id')
            ->join('item_codes', 'return_outlists.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', 'categories.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('return_outlists.id', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();
        return view('return-outlist.returned', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        // $data['code_info'] = false;
        $data['users'] = DB::table('users')
            // ->where('block_status', 1)
            ->where('role_id', '=', 'staff')
            ->orderBy('id', 'desc')
            ->get();

        $data['item_codes'] = DB::table('item_codes')
            ->where('delete_status', '=', '1')
            ->orderBy('id', 'asc')
            ->get();

        $data['category'] = DB::table('categories')
            ->select('*')
            ->where('delete_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
        return view('return-outlist.return-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->add_status);
        // dd($request->input());
        $insert = false;
        $attachment = '';
        $rules = [
            'userAccount' => 'required',
            'proCode' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',  // Added max length for consistency
            'attachment' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // Specify mime types and max size
        ];

        // Check if add_status is greater than or equal to 2
        if ($request->add_status >= 2) {
            $rules['serial_number'] = 'nullable|string|max:255|unique:products,serial_number'; // Assuming 'products' is your table name
            $rules['fix_asset_code'] = 'nullable|string|max:255|unique:products,fix_asset_code'; // Assuming 'products' is your table name
        }

        $validate = Validator::make($request->all(), $rules);


        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Validate has failed, try again!')->withInput();
        }

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment')->store('uploads/outlist-atts', 'custom');
        } else {
            $attachment = '';
        }

        // sent sseeion old file and then delete its if exist
        if ($request->add_status == 1) {
            // dd('only returned');

            $insert = DB::table('return_outlists')
                ->insert([
                    'staff_id' => $request->userAccount,
                    'returned_date' => now(),
                    'item_status' => $request->status,
                    // 'proname' => $request->proname,
                    'pro_code' => $request->proCode,
                    // 'cat_id' => $request->category,
                    'model' => $request->model,
                    'serial_number' => $request->serial_number,
                    'fix_asset_code' => $request->fix_asset_code,
                    // 'equipment_type' => $request->equipment_type,
                    'attachment' => $attachment,
                    'recieve_by' => Auth::user()->name_en,
                ]);
        } else {
            // dd('return and stock');
            $insert = DB::table('return_outlists')
                ->insert([
                    'staff_id' => $request->userAccount,
                    'returned_date' => now(),
                    'item_status' => $request->status,
                    // 'proname' => $request->proname,
                    'pro_code' => $request->proCode,
                    // 'cat_id' => $request->category,
                    'model' => $request->model,
                    'serial_number' => $request->serial_number,
                    'fix_asset_code' => $request->fix_asset_code,
                    // 'equipment_type' => $request->equipment_type,
                    'attachment' => $attachment,
                    'recieve_by' => Auth::user()->name_en,

                ]);

            $insert = DB::table('products')
                ->insert([
                    // 'pro_name_kh' => $request->proname,
                    // 'pro_name_en' => $request->proname,
                    'pro_code' => $request->proCode,
                    'model' => $request->model,
                    'serial_number' => $request->serial_number,
                    'fix_asset_code' => $request->fix_asset_code,
                    // 'cat_id' => $request->category,
                    'qty' => 1,
                    'pro_description' => $request->status,
                    'year' => date('Y'),
                    'add_by' => @Auth::user()->name_en,
                    'fix_qty' => 1,
                    // 'equipment_type' => $request->equipment_type
                ]);
        }
        if ($insert == true) {
            return redirect()->back()->with('success', 'Add new returned out list has successfully.');
        } else {
            return redirect()->back()->with('error', 'Add new returned out list has failed.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $query = DB::table('return_outlists')
            ->select(
                'return_outlists.*',
                'return_outlists.id as returned_id',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*',
                'item_codes.*'
            )
            ->join('users', 'return_outlists.staff_id', 'users.id')
            ->join('item_codes', 'return_outlists.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', 'categories.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->where('return_outlists.id', $id)
            ->orderBy('return_outlists.id', 'desc')
            ->get()->first();

            $card_id = $query->card_id ?? __("nav.newStaff");
            $gender = __("nav.". strtolower($query->gender));
            $returnDate = Carbon::parse($query->returned_date)->format('d M Y h:i:s A');
            $department = session('localization') == 'kh' ? $query->dep_name_kh : $query->dep_name_en;
            $section = session('localization') == 'kh' ? $query->section_kh : $query->section_en;
            return response()->json([
                'data' => $query,
                'card_id' => $card_id,
                'returnDate' => $returnDate,
                'department' => $department,
                'section' => $section,
                'gender' => $gender,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $data['item'] = DB::table('return_outlists')
            ->select('return_outlists.*',
                'return_outlists.id as returnOutlist_id',
                'item_codes.*',
                'categories.*'
            )->join('item_codes', 'item_codes.id', 'return_outlists.pro_code')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('return_outlists.id', $id)->get()->first();
        $data['users'] = DB::table('users')
            // ->where('block_status', 1)
            ->where('role_id', '=', 'staff')
            ->orderBy('id', 'desc')
            ->get();

        $data['category'] = DB::table('categories')
            ->select('*')
            ->where('delete_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();

        $data['item_codes'] = DB::table('item_codes')
            ->where('delete_status', '=', '1')
            ->orderBy('item_code', 'asc')
            ->get();
        if (!$data['item']) {
            return redirect()->back();
        } else {
            return view('return-outlist.return-form', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attachment = '';
        $item = DB::table('return_outlists')
            ->where('id', $id)->get()->first();
        if (!$item) {
            return redirect()->back()->with('error', 'Update returned out list has failed.');
        }

        $rules = [
            'userAccount' => 'required',
            'proCode' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',  // Added max length for consistency
            'attachment' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Specify mime types and max size
            'serial_number' => 'nullable|string|max:255|unique:return_outlists,serial_number,' . $id . ',id', // Assuming 'return_outlists' is your table name
            'fix_asset_code' => 'nullable|string|max:255|unique:return_outlists,fix_asset_code,' . $id . ',id', // Assuming 'products' is your table name
        ];

        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Validate has failed, try again!');
        }

        if ($request->hasFile('attachment')) {
            if (File::exists($item->attachment)) {
                File::delete($item->attachment);
            }
            $attachment = $request->file('attachment')->store('uploads/outlist-atts', 'custom');
        } else {
            $attachment = $item->attachment;
        }

        $update = DB::table('return_outlists')
            ->where('id', $id)
            ->update([
                'staff_id' => $request->userAccount,
                'returned_date' => now(),
                'item_status' => $request->status,
                // 'proname' => $request->proname,
                'pro_code' => $request->proCode,
                // 'cat_id' => $request->category,
                'model' => $request->model,
                'serial_number' => $request->serial_number,
                'fix_asset_code' => $request->fix_asset_code,
                // 'equipment_type' => $request->equipment_type,
                'attachment' => $attachment,
                'recieve_by' => Auth::user()->name_en,

            ]);
        return redirect()->route('returnOutList.index')->with('success', 'Update returned out list has successfully.');
        // } else {
        //     return redirect()->back()->with('error', 'Update returned out list has failed.');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportExcel()
    {
        $filename = 'return-old-item-' . now()->format('d-m-Y_h-i-s_a') . '.xlsx';
        return Excel::download(new ReturnOulistExport, $filename);
    }

    public function exportPdf()
    {
        $data = DB::table('return_outlists')
            ->select(
                'return_outlists.*',
                'return_outlists.id as returned_id',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*',
                'item_codes.*'
            )
            ->join('users', 'return_outlists.staff_id', 'users.id')
            ->join('item_codes', 'return_outlists.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', 'categories.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('return_outlists.id', 'desc')->get();

        $html = view('pdf.return-outlist', ['items' => $data, 'title' => __("nav.returnOutlist")])->render();
        return PdfKh::loadHtml($html)->addMPdfConfig([
            'format' => 'A4-L',
        ])->download('return-old-item-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
