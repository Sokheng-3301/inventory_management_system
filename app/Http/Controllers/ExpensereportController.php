<?php

namespace App\Http\Controllers;

use App\Exports\ExpenseReportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use Illuminate\Support\Facades\Validator;

class ExpensereportController extends Controller
{
    public function index(Request $request)
    {
        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();
        // $data['expenses'] = '';

        $query = DB::table('products')
            ->select('products.*', 'products.id as proId', 'products.add_by as operator', 'categories.*', 'item_codes.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('products.price', '!=', null)
            ->orderBy('products.id', 'desc');

        $year = $request->year;
        $equipment_type = $request->equipment_type;

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date) {
            $start_date = date_create($start_date);
            // $start_date = Carbon::parse($start_date)->format('Y-m-d');
        }

        if ($end_date) {
            $end_date = date_create($end_date);
            // $end_date = Carbon::parse($end_date)->format('Y-m-d');
        }
        // $end_date = $request->end_date;

        if ($year != '' && empty($equipment_type)  && empty($start_date)  && empty($end_date)) {
            // year only
            $data['expenses'] = $query->where('products.year', now()->year)->get();
        } elseif ($year != '' && $equipment_type != ''  && empty($start_date)  && empty($end_date)) {
            // echo 'year and equipment';
            $data['expenses'] = $query->where('products.year', now()->year)
                ->where('item_codes.equipment_type', $equipment_type)
                ->get();
        } elseif ($year != '' && $equipment_type != ''  && $start_date  && empty($end_date)) {
            // echo 'equipment and start date to now';
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                now()->format('Y-m-d')
            ])->where('item_codes.equipment_type', $equipment_type)->get();
        } elseif ($year != '' && $equipment_type != '' && !empty($start_date) && !empty($end_date)) {
            // Fetch expenses based on equipment type and date range
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $start_date,
                $end_date
            ])->where('products.equipment_type', $equipment_type)->get();
        } elseif ($year != '' && empty($equipment_type)  && $start_date  && $end_date) {
            // echo 'start date and end date';
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $start_date,
                $end_date
            ])->get();
        } elseif ($year != '' && empty($equipment_type)  && $start_date  && empty($end_date)) {
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $start_date,
                now()->format('Y-m-d')
            ])->get();
        } else {
            $data['expenses'] = $query->where('products.year', now()->year)->get();
        }


        $data['categories'] = DB::table('pr_table')
            ->select('category')
            ->distinct()
            ->where('purchase_status', 1)
            ->get();
        // dd($data['categories']);
        return view('reports.expense', $data);
    }

    // public function search(Request $r)
    // {
    //     // dd($r->input());
    //     $result['start_date'] = null;
    //     $result['end_date'] = null;

    //     $year = $r->year;
    //     if (($r->start_date && $r->end_date) != '') {
    //         $start_date = $r->start_date . ' 00:00:00';
    //         $end_date = $r->end_date . ' 23:59:59';

    //         $result['start_date'] = $r->start_date;
    //         $result['end_date'] = $r->end_date;

    //         $result['expenses'] = DB::table('pr_table')
    //             ->select(
    //                 'pr_table.*',
    //                 'pr_table.id as purchase_id',
    //                 'pr_table.add_by as purchaser',
    //                 'pr_table.delete_status as pr_delete_status',
    //                 'pr_table.delete_date as pr_delete_date',
    //                 'pr_table.delete_by as pr_delete_by',
    //                 'users.*',
    //                 // 'staff_users.*',
    //                 'departments.*',
    //                 'categories.*',
    //                 'positions.*',
    //                 'section.*',
    //             )
    //             ->where('pr_table.purchase_status', 1)
    //             ->where('pr_table.delete_status', 1)
    //             ->where('pr_table.year', date('Y'))
    //             ->whereBetween('pr_date', [$start_date, $end_date])
    //             ->join('users', 'users.id', '=', 'pr_table.requester')
    //             ->join('categories', 'pr_table.category', '=', 'categories.id')
    //             // ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id') // Fixed table name
    //             ->join('positions', 'positions.id', '=', 'users.position')
    //             ->join('section', 'positions.section_id', '=', 'section.id')
    //             ->join('departments', 'section.department_id', '=', 'departments.id')
    //             // ->orderBy('pr_table.add_stock_status', 'desc')
    //             // ->orderBy('pr_table.pr_table.id', 'desc') // Specify table name for clarity
    //             ->orderBy('pr_table.receive_date', 'desc')
    //             ->get();
    //         // dd($result['expenses']);

    //         $result['categories'] = DB::table('pr_table')
    //             ->select('category')
    //             ->distinct()
    //             ->where('purchase_status', 1)
    //             ->where('year', $year)
    //             ->whereBetween('pr_date', [$start_date, $end_date])
    //             ->get();
    //     } else {
    //         $result['expenses'] = DB::table('pr_table')
    //             ->select(
    //                 'pr_table.*',
    //                 'pr_table.id as purchase_id',
    //                 'pr_table.add_by as purchaser',
    //                 'pr_table.delete_status as pr_delete_status',
    //                 'pr_table.delete_date as pr_delete_date',
    //                 'pr_table.delete_by as pr_delete_by',
    //                 'users.*',
    //                 // 'staff_users.*',
    //                 'departments.*',
    //                 'categories.*',
    //                 'positions.*',
    //                 'section.*',
    //             )
    //             ->where('pr_table.purchase_status', 1)
    //             ->where('pr_table.delete_status', 1)
    //             ->where('pr_table.year', date('Y'))
    //             // ->orWhereBetween('pr_date', [$start_date, $end_date])
    //             ->join('users', 'users.id', '=', 'pr_table.requester')
    //             ->join('categories', 'pr_table.category', '=', 'categories.id')
    //             // ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id') // Fixed table name
    //             ->join('positions', 'positions.id', '=', 'users.position')
    //             ->join('section', 'positions.section_id', '=', 'section.id')
    //             ->join('departments', 'section.department_id', '=', 'departments.id')
    //             // ->orderBy('pr_table.add_stock_status', 'desc')
    //             // ->orderBy('pr_table.id', 'desc') // Specify table name for clarity
    //             ->orderBy('pr_table.receive_date', 'desc')
    //             ->get();

    //         $result['categories'] = DB::table('pr_table')
    //             ->select('category')
    //             ->distinct()
    //             ->where('purchase_status', 1)
    //             ->where('year', $year)
    //             // ->orWhereBetween('pr_date', [$start_date, $end_date])
    //             ->get();
    //     }
    //     $result['action'] = DB::table('apply_funcion_for_role')
    //         ->where('role_id', @Auth::user()->role_id)
    //         ->get()->first();
    //     return view('reports.expense', $result);
    // }

    public function create()
    {
        $data['update'] = false;
        // $data['expense_report'] = false;
        $data['item_codes'] = DB::table('item_codes')
            ->where('delete_status', '=', '1')
            ->orderBy('item_code', 'asc')
            ->get();
        $data['categories'] = DB::table('categories')
            ->select('*')
            ->where('delete_status', '=', '1')
            ->orderBy('cat_name', 'asc')
            ->get();
        return view('reports.add', $data);
    }

    /*
        public function store(Request $request)
        {
            $countItemForm = $request->countItemForm;
            for ($i = 1; $i <= $countItemForm; $i++) {
                $validate = Validator::make($request->all(), [
                    'proname_' . $i => 'required',
                    'serial_number_' . $i => 'nullable|unique:products,serial_number',
                    'fix_asset_code_' . $i => 'nullable|unique:products,fix_asset_code',
                    'category_' . $i => 'required',
                    'equipment_type_' . $i => 'required',
                    'qty_' . $i => 'required|numeric|min:0',
                    'unit_price_' . $i => 'required|numeric|min:0',
                ]);
                if ($validate->fails()) {
                    return redirect()->back()->with('error', 'Somethings went wrong, try again!')->withInput();
                }


                $insert = DB::table('products')->insert([
                    'pro_name_kh' => $request->input("proname_$i"),
                    'pro_name_en' => $request->input("proname_$i"),
                    'pro_code' => $request->input("proCode_$i"),
                    'model' => $request->input("model_$i"),
                    'serial_number' => $request->input("serial_number_$i"),
                    'fix_asset_code' => $request->input("fix_asset_code_$i"),
                    'cat_id' => $request->input("category_$i"),
                    'qty' => $request->input("qty_$i"),
                    'pro_description' => $request->input("descript_$i"),
                    'year' => date('Y'),
                    'add_by' => Auth::user() ? Auth::user()->name_en : null, // Handle case if user is not authenticated
                    'fix_qty' => $request->input("qty_$i"),
                    'equipment_type' => $request->input("equipment_type_$i"),
                    'price' => $request->input("unit_price_$i"),
                ]);
            }

            if ($insert == true) return redirect()->back()->with('success', 'Add expense report has successfully.');
            else return redirect()->back()->with('error', 'Add expense report has failed.')->withInput();
        }
    */
    public function store(Request $request)
    {
        // dd($request->input());

        $validate = Validator::make($request->all(), [
            'proCode' => 'required|string|max:255', // Added max length for consistency
            'serial_number' => 'nullable|string|max:255|unique:products,serial_number', // Exclude current record if editing
            'qty' => 'required|numeric|min:1', // Added minimum quantity check
            'price' => 'required|numeric|min:0', // Ensured price cannot be negative
        ]);


        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Validate has failed!')->withInput();
        }


        if ($request->hasFile('proImage')) {
            $proImage = $request->file('proImage')->store('uploads/products', 'custom');
        } else {
            $proImage = '';
        }


        // $addBy = Auth::user()->name_en;
        $proCode = $request->proCode;
        $model = $request->model;
        $serial_number = $request->serial_number;
        $fix_asset_code = $request->fix_asset_code;
        $qty     = $request->qty;
        $desctipt = $request->descript;
        $price = $request->price;

        $insert = DB::table('products')
            ->insert([
                'pro_img' => $proImage,
                'pro_code' => $proCode,
                'model' => $model,
                'serial_number' => $serial_number,
                'fix_asset_code' => $fix_asset_code,
                'qty' => $qty,
                'pro_description' => $desctipt,
                'year' => date('Y'),
                'add_by' => Auth::user()->name_en,
                'fix_qty' => $qty,
                'price' => $price,
                'expense_date' => now(),
            ]);
        if ($insert == true) {
            return redirect()->back()->with('success', 'Add expense report has successfully.');
        } else {
            return redirect()->back()->with('error', 'Add expense report has failed.');
        }
    }

    public function show(string $id){
        dd('hello world');
    }

    public function edit(string $id)
    {
        // dd($id);
        // exit;
        $data['update'] = true;
        $data['item'] = DB::table('products')
            ->select('products.*', 'products.id as proId', 'categories.*', 'item_codes.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('products.price', '!=', null)
            ->where('products.id', $id)
            ->get()->first();


        $data['item_codes'] = DB::table('item_codes')
            ->where('delete_status', '=', '1')
            ->orderBy('item_code', 'asc')
            ->get();

        $data['categories'] = DB::table('categories')
            ->select('*')
            ->where('delete_status', '=', '1')
            ->orderBy('cat_name', 'asc')
            ->get();

        $referer = request()->headers->get('referer');
        $data['queryString'] = parse_url($referer, PHP_URL_QUERY);

        if (!$data['item']) {
            return redirect()->back();
        } else {
            return view('reports.add', $data);
        }
    }

    public function update(Request $request, string $id)
    {
        // dd($id);
        // dd($request->input());
        // Validate the incoming request data
        $validate = Validator::make($request->all(), [
            'proCode' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255|unique:products,serial_number,' . $id . ',id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Check for validation failures
        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Validation failed, please try again!')->withInput();
        }

        // Ensure the product exists and has a price
        $productExists = DB::table('products')
            ->where('id', $id)
            ->where('price', '!=', null)
            ->get()->first();

        if (!$productExists) {
            return redirect()->back()->with('error', 'Update failed: Product not found or has no price.')->withInput();
        }

        if ($request->hasFile('proImage')) {
            if(File::exists($productExists->pro_img)){
                File::delete($productExists->pro_img);
            }
            $proImage = $request->file('proImage')->store('uploads/products', 'custom');
        } else {
            $proImage = $productExists->pro_img;
        }

        // Prepare update data
        $user = Auth::user();
        $proCode = $request->proCode;
        $model = $request->model;
        $serial_number = $request->serial_number;
        $fix_asset_code = $request->fix_asset_code;
        $qty     = $request->qty;
        $desctipt = $request->descript;
        $price = $request->price;

        DB::table('products')
            ->where('id', $id)
            ->update([
                'pro_img' => $proImage,
                'pro_code' => $proCode,
                'model' => $model,
                'serial_number' => $serial_number,
                'fix_asset_code' => $fix_asset_code,
                'qty' => $qty,
                'pro_description' => $desctipt,
                'year' => date('Y'),
                'add_by' => Auth::user()->name_en,
                'fix_qty' => $qty,
                'price' => $price,
                'expense_date' => now(),
            ]);

        // Perform the update operation
        // $updateExpense = DB::table('products')->where('id', $id)->update($updateData);

        // Check if the update was successful
        // if ($updateExpense) {
            return redirect()->route('expense.purchase.index', $request->queryString)
                ->with('success', 'Update completed successfully.');
        // }

        // return redirect()->route('expense.purchase.index', $request->queryString)->with('error', 'Update failed, please try again.')->withInput();
    }

    public function exportExcel(Request $request)
    {
        $filename = 'expenses-report-' . now()->format('d-m-Y_h-i-s_a') . '.xlsx';
        return Excel::download(new ExpenseReportExport(
            $request->year,
            $request->equipment_type,
            $request->start_date,
            $request->end_date
        ), $filename);
    }

    public function exportPdf(Request $request)
    {
        // dd($request->all());
        $query = DB::table('products')
            ->select('products.*', 'products.id as proId', 'products.add_by as operator', 'categories.*', 'item_codes.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('products.price', '!=', null)
            ->orderBy('products.id', 'desc');

        $year = $request->year;
        $equipment_type = $request->equipment_type;

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date) {
            $start_date = date_create($start_date);
        }
        if ($end_date) {
            $end_date = date_create($end_date);
        }
        // $end_date = $request->end_date;

        if ($year != '' && empty($equipment_type)  && empty($start_date)  && empty($end_date)) {
            // year only
            $data['expenses'] = $query->where('products.year', now()->year)->get();
        } elseif ($year != '' && $equipment_type != ''  && empty($start_date)  && empty($end_date)) {
            // echo 'year and equipment';
            $data['expenses'] = $query->where('products.year', now()->year)
                ->where('item_codes.equipment_type', $equipment_type)
                ->get();
        } elseif ($year != '' && $equipment_type != ''  && $start_date  && empty($end_date)) {
            // echo 'equipment and start date to now';
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                now()->format('Y-m-d')
            ])->where('item_codes.equipment_type', $equipment_type)->get();
        } elseif ($year != '' && $equipment_type != '' && !empty($start_date) && !empty($end_date)) {
            // Fetch expenses based on equipment type and date range
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $start_date,
                $end_date
            ])->where('item_codes.equipment_type', $equipment_type)->get();
        } elseif ($year != '' && empty($equipment_type)  && $start_date  && $end_date) {
            // echo 'start date and end date';
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $start_date,
                $end_date
            ])->get();
        } elseif ($year != '' && empty($equipment_type)  && $start_date  && empty($end_date)) {
            $data['expenses'] = $query->whereBetween('products.expense_date', [
                $start_date,
                now()->format('Y-m-d')
            ])->get();
        } else {
            $data['expenses'] = $query->where('products.year', now()->year)->get();
        }


        $html = view('pdf.expense', ['items' => $data['expenses'], 'title' => __("nav.expenseReport")])->render();
        return PdfKh::loadHtml($html)->addMPdfConfig([
            'format' => 'A4-L',
        ])->download('expenses-report-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
