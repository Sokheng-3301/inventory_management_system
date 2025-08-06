<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Exports\ProductGivenExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class GivenItemController extends Controller
{
    public function addGive()
    {
        $data['products_equipment'] = DB::table('products')
            ->select('products.*', 'products.id as proId', 'item_codes.*', 'categories.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'categories.id', '=', 'item_codes.item_cat')
            ->where('products.stock_status', 1)
            ->where('item_codes.equipment_type', 1)
            ->where('products.delete_status', 1)
            ->orderBy('products.id', 'desc')
            ->get();
        $data['products_accessories'] = DB::table('products')
            ->select('products.*', 'products.id as proId', 'item_codes.*', 'categories.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'categories.id', '=', 'item_codes.item_cat')
            ->where('products.stock_status', 1)
            ->where('item_codes.equipment_type', 2)
            ->where('products.delete_status', 1)
            ->orderBy('products.id', 'desc')
            ->get();


        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();


        $data['users'] = DB::table('users')
            // ->where('block_status', 1)
            ->where('role_id', '=', 'staff')
            ->orderBy('id', 'desc')
            ->get();


        // $data['category'] = DB::table('categories')
        //     ->select('*')
        //     ->where('delete_status', '=', '1')
        //     ->orderBy('id', 'desc')
        //     ->get();


        return view('product.add-give', $data);
    }


    public function give(Request $r)
    {
        // dd($r->input());
        $run = false;
        $att = '';
        $validate = Validator::make($r->all(), [
            'userAccount' => 'required',
            'products' => 'required',
            'giveDate' => 'required',
            'attachment' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Plese complete fields.')->withInput();
        }

        $products = $r->products;
        $userId = $r->userAccount;
        // $givenDateinput = date_create($r->giveDate);
        $giveDate = Carbon::parse($r->giveDate)->format('Y-m-d');
        // echo  $giveDate;
        // exit;
        if ($r->hasFile('attachment')) {
            $att = $r->file('attachment')->store('uploads/give-atts', 'custom');
        } else {
            $att = '';
        }

        $productExplode = implode(',', $products);
        $insertGive = DB::table('give_table')
            ->insert([
                'staff_id' => $userId,
                'product_id' => $productExplode,
                'constant_proid' => $productExplode,
                // 'qty' => $qty,
                'date' => $giveDate,
                'attachment' => $att,
                'add_by' => @Auth::user()->name_en,
                'year' => date('Y')
            ]);

        if ($insertGive == true) {
            foreach ($products as $product) {
                $product_qty = DB::table('products')
                    ->where('id', $product)
                    ->get()->first();

                $updateQty = ($product_qty->qty) - 1;

                if ($updateQty == 0) {
                    DB::table('products')
                        ->where('id', $product)
                        ->update(['qty' => $updateQty, 'stock_status' => 0]);
                } else {
                    DB::table('products')
                        ->where('id', $product)
                        ->update(['qty' => $updateQty]);
                }
            }

            // /log record here
            foreach ($r->products as $pro_id) {
                DB::table('product_locks')->insert([
                    'product_id' => $pro_id,
                    'give_date' => $giveDate . ' ' . now()->format('h:i:s'),
                    'give_user' => $r->userAccount,
                    'give_by' => @Auth::user()->name_kh . ' - ' . @Auth::user()->name_en,
                ]);
            }

            return redirect()->back()->with('success', 'Add new item given has successfully.');
        } else {
            return redirect()->back()->with('error', 'Add new item given has failed.');
        }
    }


    public function addGiveEdit($id)
    {

        $check = DB::table('give_table')
            ->where('id', $id)
            ->exists();
        if ($check == false) {
            return redirect()->route('product.givenList');
        }


        $data['give_data'] = DB::table('give_table')
            ->where('id', $id)
            ->first();

        // $data['products'] = DB::table('products')
        //     ->orderBy('products.id', 'desc')
        //     ->orderBy('products.delete_status', 'desc')
        //     ->get();

        $data['products_equipment'] = DB::table('products')
            ->select('products.*', 'products.id as proId', 'item_codes.*', 'categories.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'categories.id', '=', 'item_codes.item_cat')
            // ->where('products.stock_status', 1)
            ->where('item_codes.equipment_type', 1)
            ->where('products.delete_status', 1)
            ->orderBy('products.id', 'desc')
            ->get();
        $data['products_accessories'] = DB::table('products')
            ->select('products.*', 'products.id as proId', 'item_codes.*', 'categories.*')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'categories.id', '=', 'item_codes.item_cat')
            // ->where('products.stock_status', 1)
            ->where('item_codes.equipment_type', 2)
            ->where('products.delete_status', 1)
            ->orderBy('products.id', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();


        $data['users'] = DB::table('users')
            // ->where('block_status', 1)
            ->where('role_id', '=', 'staff')
            ->orderBy('id', 'desc')
            ->get();


        // $data['category'] = DB::table('categories')
        //     ->select('*')
        //     ->where('delete_status', '=', '1')
        //     ->orderBy('id', 'desc')
        //     ->get();

        return view('product.edit-give', $data);
    }


    public function doEditGiven(Request $request, $id)
    {
        $check = DB::table('give_table')
            ->where('id', $id)->get()->first();
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'userAccount' => 'required',
            'giveDate' => 'required',
            'old_att' => 'required',
        ]);

        // Check for validation failures
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Fields are required.')->withErrors($validator);
        }

        $userId = $request->userAccount;
        // $givenDateInput = date_create($request->giveDate);
        // $giveDate = date_format($givenDateInput, 'd/M/Y');
        $giveDate = Carbon::parse($request->giveDate)->format('Y-m-d');

        // dd($giveDate);

        // Handle file attachment
        $attachment = $request->old_att; // Default to old attachment

        if ($request->hasFile('attachment')) {
            // Delete old attachment if it exists
            if (File::exists($attachment)) {
                File::delete($attachment);
            }

            // Store the new attachment
            $attachment = $request->file('attachment')->store('uploads/give-atts', 'custom');
        }

        // Update the record in the database

        // dd("Update code");

        $updated = DB::table('give_table')
            ->where('id', $id)
            ->update([
                'staff_id' => $userId,
                'date' => $giveDate,
                'attachment' => $attachment,
                'add_by' => Auth::user()->name_en,
            ]);

        // Check if the update was successful
        if ($updated) {
            $productIds = explode(',', $check->product_id);

            // /log record here
            foreach ($productIds as $pro_id) {
                DB::table('product_locks')->insert([
                    'product_id' => $pro_id,
                    'give_date' => $giveDate . ' ' . now()->format('h:i:s'),
                    'give_user' => $request->userAccount,
                    'give_by' => @Auth::user()->name_kh . ' - ' . @Auth::user()->name_en,
                ]);
            }
        }
        return redirect()->route('product.givenList')->with('success', 'Add new item given has successfully..');
        // else {
        //     return redirect()->back()->with('error', true)->with('error', 'Update new item given has failed.');
        // }
    }

    // give function start
    public function givenList()
    {
        $data['product'] = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                'give_table.add_by as operator',
                'give_table.return_any_product',
                'products.pro_img',
                'products.id as proId',
                'products.model',
                'products.fix_asset_code',
                'products.serial_number',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*',
                'item_codes.*'
            )
            ->where('give_table.return_status', 1)
            ->where('give_table.year', date('Y'))
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')

            // ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')

            ->join('categories', 'item_codes.item_cat', 'categories.id')

            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('give_table.id', 'desc')
            // ->orderBy('give_table.date', 'asc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        return view('product.given', $data);
    }

    public function givenSearch(Request $r)
    {
        $giveDate = '';
        $year = $r->year;
        $month = $r->month;
        $week = $r->week;
        $giveDateInput = $r->giveDate;

        $department = $r->department;
        $section = $r->section;
        $position = $r->position;
        $staff_id = $r->staff_id;

        $data['year'] = $year;
        $data['month'] = $month;
        $data['week'] = $week;
        $data['giveDate'] = $giveDateInput;
        $data['department'] = $department;
        $data['section'] = $section;
        $data['position'] = $position;
        $data['staff_id'] = $staff_id;

        if ($giveDateInput != '') {
            $giveDate = date_create($giveDateInput);
            $giveDate = date_format($giveDate, 'Y-m-d');
        } else {
            $giveDate = '';
        }

        $query = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                'give_table.add_by as operator',
                'give_table.return_any_product',
                'products.pro_img',
                'products.id as proId',
                'products.model',
                'products.fix_asset_code',
                'products.serial_number',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*',
                'item_codes.*'
            )
            ->where('give_table.return_status', 1)
            // ->where('give_table.year', date('Y'))
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            // ->orderBy('give_table.id', 'desc');
            ->orderBy('give_table.date', 'asc');


        if (($year != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $data['product'] = $query->where('give_table.year', $year)->get();
        }
        if (($month != '') && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $data['product'] = $query->where('give_table.year', $year)
                ->whereMonth('give_table.date', $month)->get();
        }

        if (($week != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-m-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly
            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');

            $data['product'] = $query->where('give_table.year', $year)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])->get();
        }

        if ((($giveDate != '') && empty($month) && empty($week) && empty($department) && empty($section) && empty($position) && empty($staff_id)) || $giveDate != '') {
            $data['product'] = $query
                ->where('give_table.year', $year)
                ->whereDate('give_table.date', $giveDate)->get();
        }

        // if (($department != '') && empty($month) && empty($week) && empty($giveDate) && empty($section) && empty($position) && empty($staff_id)) {
        if (($department != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('departments.id', $department)->get();
        }

        // if (($section != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($position) && empty($staff_id)) {
        if (($section != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('section.id', $section)->get();
        }
        // if (($position != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($staff_id)) {
        if (($position != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('positions.id', $position)->get();
        }

        if (($staff_id != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) || $staff_id != '') {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('users.card_id', 'LIKE', "%{$staff_id}%")->get();
        }


        if (($year && $month && $week && $department && $section && $position) != '') {
            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-' . $month . '-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly

            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');
            $data['product'] = $query
                ->where('give_table.year', $year)
                // ->whereMonth('give_table.date', $month)
                ->where('positions.id', $position)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])
                ->where('users.card_id', 'LIKE', "%{$staff_id}%")->get();
        }

        if ((!empty($year) && !empty($month) && !empty($week)) && (empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id))) {

            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-' . $month . '-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly

            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');

            // echo $start_weekly . "<br>";
            // echo $end_weekly;
            // exit;

            $data['product'] = $query->where('give_table.year', $year)
                // ->whereMonth('give_table.date', $month)
                // ->where('positions.id', $position)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])->get();
        }


        if (($year && $month) != '' && (empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id))) {
            // $start_day = ($week - 1) * 7 + 1; // Start day of the week
            // $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-'. $month .'-' . sprintf('%02d', $start_day)));
            // $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly


            // $start_weekly = substr($start_weekly, '0', '10');
            // $end_weekly = substr($end_weekly, '0', '10');

            $data['product'] = $query->where('give_table.return_status', 1)
                ->where('give_table.year', $year)
                ->whereMonth('give_table.date', $month)->get();
        }

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        // foreach ($data['product'] as $p) {
        //     // print_r($p);
        //     echo $p->item_name_kh;
        // }
        return view('product.given', $data);
    }


    public function givenDetail(string $id)
    {
        $productGiven = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                'give_table.add_by as operator',
                'give_table.return_any_product',
                'products.*',
                'products.id as proId',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'item_codes.*',
                'categories.*'
            )
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', '=', 'section.department_id')
            ->where('give_table.id', $id)
            ->first();

        // Check if productGiven is null
        if (!$productGiven) {
            return response()->json([
                'message' => false,
                'data' => 'Product not found',
            ]);
        }

        // Get product IDs from the given product
        $productIds = explode(',', $productGiven->product_id);

        // Fetch all products in a single query
        $products = DB::table('products')
            ->select(
                'products.*',
                'products.id as proId',
                'item_codes.*',
                'categories.*'
            )
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->whereIn('products.id', $productIds)
            ->get();

        if (session()->has('localization') && session('localization') == 'en') {
            $department = $productGiven->dep_name_en;
            $section = $productGiven->section_en;
        } else {
            $department = $productGiven->dep_name_kh;
            $section = $productGiven->section_kh;
        }
        $gender = __('nav.' . strtolower($productGiven->gender));
        $return_date = Carbon::parse($productGiven->date)->format('d M Y');
        $card_id = $productGiven->card_id ?? __('nav.newStaff');
        return response()->json([
            'message' => true,
            'data' => [
                'gender' => $gender,
                'department' => $department,
                'section' => $section,
                'returnDate' => $return_date,
                'productGiven' => $productGiven,
                'relatedProducts' => $products,
                'card_id' => $card_id,
            ],
        ]);
    }


    // export given product
    public function givenExport(Request $request)
    {
        $filename = 'product-given-list-' . now()->format('d-m-Y_h-i-s_a') . '.xlsx';
        $givenDateInput = '';

        if ($request->givenDate != '') {
            $givenDateInput = Carbon::parse($request->givenDate)->format('Y-m-d');
        } else {
            $givenDateInput = ''; // You can also omit this line as it already defaults to an empty string.
        }

        return Excel::download(new ProductGivenExport(
            $request->year,
            $request->month,
            $request->week,
            $givenDateInput,
            $request->department,
            $request->section,
            $request->position,
            $request->staff_id,
            $request
        ), $filename);
    }


    // export pdf for give product list
    public function exportPdf(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $week = $request->week;
        $giveDateInput = $request->giveDate;
        $department = $request->department;
        $section = $request->section;
        $position = $request->position;
        $staff_id = $request->staff_id;


        $data['year'] = $year;
        $data['month'] = $month;
        $data['week'] = $week;
        $data['giveDate'] = $giveDateInput;
        $data['department'] = $department;
        $data['section'] = $section;
        $data['position'] = $position;
        $data['staff_id'] = $staff_id;


        if ($giveDateInput != '') {
            $giveDate = date_create($giveDateInput);
            $giveDate = date_format($giveDate, 'Y-m-d');
        } else {
            $giveDate = '';
        }


        $query = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                'give_table.add_by as operator',
                'give_table.return_any_product',
                'products.pro_img',
                'products.id as proId',
                'products.model',
                'products.fix_asset_code',
                'products.serial_number',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*',
                'item_codes.*'
            )
            ->where('give_table.return_status', 1)
            // ->where('give_table.year', date('Y'))
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('give_table.date', 'asc');


        if (($year != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $data['product'] = $query->where('give_table.year', $year)->get();
        }
        if (($month != '') && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $data['product'] = $query->where('give_table.year', $year)
                ->whereMonth('give_table.date', $month)->get();
        }


        if (($week != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id)) {
            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-m-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly
            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');

            $data['product'] = $query->where('give_table.year', $year)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])->get();
        }


        if ((($giveDate != '') && empty($month) && empty($week) && empty($department) && empty($section) && empty($position) && empty($staff_id)) || $giveDate != '') {
            $data['product'] = $query
                ->where('give_table.year', $year)
                ->whereDate('give_table.date', $giveDate)->get();
        }


        // if (($department != '') && empty($month) && empty($week) && empty($giveDate) && empty($section) && empty($position) && empty($staff_id)) {
        if (($department != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('departments.id', $department)->get();
        }

        // if (($section != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($position) && empty($staff_id)) {
        if (($section != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('section.id', $section)->get();
        }
        // if (($position != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($staff_id)) {
        if (($position != '')) {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('positions.id', $position)->get();
        }

        if (($staff_id != '') && empty($month) && empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) || $staff_id != '') {
            $data['product'] = $query->where('give_table.year', $year)
                ->where('users.card_id', 'LIKE', "%{$staff_id}%")->get();
        }


        if (($year && $month && $week && $department && $section && $position) != '') {

            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-' . $month . '-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly


            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');

            $data['product'] = $query
                ->where('give_table.year', $year)
                // ->whereMonth('give_table.date', $month)
                ->where('positions.id', $position)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])
                ->where('users.card_id', 'LIKE', "%{$staff_id}%")->get();
        }

        if ((!empty($year) && !empty($month) && !empty($week)) && (empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id))) {

            $start_day = ($week - 1) * 7 + 1; // Start day of the week
            $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-' . $month . '-' . sprintf('%02d', $start_day)));
            $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly


            $start_weekly = substr($start_weekly, '0', '10');
            $end_weekly = substr($end_weekly, '0', '10');

            // echo $start_weekly . "<br>";
            // echo $end_weekly;
            // exit;

            $data['product'] = $query->where('give_table.year', $year)
                // ->whereMonth('give_table.date', $month)
                // ->where('positions.id', $position)
                ->whereBetween('give_table.date', [$start_weekly, $end_weekly])->get();
        }


        if (($year && $month) != '' && (empty($week) && empty($giveDate) && empty($department) && empty($section) && empty($position) && empty($staff_id))) {
            // $start_day = ($week - 1) * 7 + 1; // Start day of the week
            // $start_weekly = Carbon::createFromFormat('Y-m-d', date($year . '-'. $month .'-' . sprintf('%02d', $start_day)));
            // $end_weekly = $start_weekly->copy()->addDays(7); // Use copy to avoid modifying $start_weekly


            // $start_weekly = substr($start_weekly, '0', '10');
            // $end_weekly = substr($end_weekly, '0', '10');

            $data['product'] = $query->where('give_table.return_status', 1)
                ->where('give_table.year', $year)
                ->whereMonth('give_table.date', $month)->get();
        }


        if (empty($request->input())) {
            $data['product'] = DB::table('give_table')
                ->select(
                    'give_table.*',
                    'give_table.id as giveId',
                    'give_table.add_by as operator',
                    'give_table.return_any_product',
                    'products.pro_img',
                    'products.pro_name_en',
                    'products.pro_name_kh',
                    'products.pro_code',
                    'products.id as proId',
                    'products.model',
                    'products.fix_asset_code',
                    'products.serial_number',
                    'users.*',
                    'positions.*',
                    'section.*',
                    'departments.*',
                    'categories.*'
                )
                ->where('give_table.return_status', 1)
                ->where('give_table.year', date('Y'))
                ->join('products', 'give_table.product_id', '=', 'products.id')
                ->join('categories', 'products.cat_id', 'categories.id')
                ->join('users', 'give_table.staff_id', '=', 'users.id')
                ->join('positions', 'positions.id', '=', 'users.position')
                ->join('section', 'positions.section_id', '=', 'section.id')
                ->join('departments', 'departments.id', 'section.department_id')
                ->orderBy('give_table.id', 'desc')
                ->get();
        }

        $html = view('pdf.pdf', ['title' => __("nav.proGiven"), 'products' => $data['product']])->render();
        return PdfKh::loadHtml($html)->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_top' => 10,
            'margin_bottom' => 10
        ])->download('given-product-list-' . now()->format('d-M-Y__H_i_s_A') . '.pdf');
    }
    // -----------Given fucntion -----------------
}
