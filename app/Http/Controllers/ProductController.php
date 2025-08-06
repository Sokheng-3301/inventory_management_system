<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Exports\ItemTrashbinExport;
use App\Exports\ProductGivenExport;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
// use Ramsey\Collection\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductInstockExport;
use App\Exports\ProductOutstockExport;
use App\Exports\ProductStatisticExport;
use Illuminate\Support\Facades\Storage;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use App\Exports\ProductHasReturnedExport;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Contracts\Auth\Authenticatable;

class ProductController extends Controller
{
    //
    // Login Authentication
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function instock()
    {
        $data['instock'] = true;
        $data['products'] = DB::table('products')
            ->select('products.*', 'products.add_by as operator',
            'categories.cat_name', 'item_codes.item_code',
            'item_codes.item_name_kh', 'item_codes.item_name_en',
            'item_codes.equipment_type', 'products.equipment_type as eq_type')
            ->where('products.stock_status', 1)
            ->where('products.qty', '>=', '1')
            ->where('products.delete_status', 1)
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.id', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();


        $data['users'] = DB::table('users')
            ->where('block_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('product.list', $data);
    }


    public function outstock()
    {
        $data['instock'] = false;
        $data['products'] = DB::table('products')
            ->select('products.*', 'categories.cat_name',
            'item_codes.item_code', 'item_codes.item_name_kh',
            'item_codes.item_name_en',
            'item_codes.equipment_type',
            'products.equipment_type as eq_type')
            ->where('products.stock_status', 0)
            ->where('products.qty', '<=', '0')
            ->where('products.delete_status', 1)
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.id', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        $data['users'] = DB::table('users')
            ->where('block_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('product.list', $data);
    }

    public function trashbin()
    {
        $data['products'] = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'item_codes.item_code', 'item_codes.item_name_kh', 'item_codes.item_name_en')
            ->where('products.delete_status', 0)
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.delete_date', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        $data['users'] = DB::table('users')
            ->where('block_status', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('product.trashbin', $data);
    }

    public function show(string $id)
    {
        // dd($id);
        $data['item_instock'] = true;
        $data['item'] = DB::table('products')
            ->select('products.*', 'products.add_by as operator', 'categories.cat_name', 'item_codes.item_code', 'item_codes.item_name_kh', 'item_codes.item_name_en')
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('products.id', $id)
            ->get()->first();
        // dd($product);

        return view('product.product-detail', $data);


        // $product = DB::table('products')
        //     ->select('products.*', 'categories.cat_name', 'categories.id as cat_id')
        //     ->where('products.stock_status', 1)
        //     ->join('categories', 'products.cat_id', '=', 'categories.id')
        //     ->where('products.id', $id)
        //     ->orderBy('products.id', 'desc')
        //     ->orderBy('categories.id', 'asc')
        //     ->orderBy('products.delete_status', 'desc')
        //     ->first();
        // $create_at = Carbon::parse($product->create_date)->format('d M Y');
        // return response()->json([
        //     'message' => true,
        //     'create_at' => $create_at,
        //     'data' => $product,
        // ]);
    }


    public function showOutstock(string $id)
    {
        $product = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'categories.id as cat_id')
            ->where('products.stock_status', 0)
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->where('products.id', $id)
            ->orderBy('products.id', 'desc')
            ->orderBy('categories.id', 'asc')
            ->orderBy('products.delete_status', 'desc')
            ->first();
        $create_at = Carbon::parse($product->create_date)->format('d M Y');
        return response()->json([
            'message' => true,
            'create_at' => $create_at,
            'data' => $product,
        ]);
    }


    public function statistic()
    {
        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();
        // $data['categories'] = DB::table('categories')->orderBy('delete_status', 'desc')->orderBy('id', 'desc')->get();

        $item_codes = DB::table('item_codes')
            ->where('delete_status', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($item_code) {
                $item_code->total_qty = DB::table('products')
                    ->where('pro_code', $item_code->id)
                    ->where('delete_status', 1)
                    // ->where('year', $currentYear)
                    ->sum('fix_qty');
                return $item_code;
            });
        $data['item_code_counts'] = $item_codes;

        return view('product.statistic', $data);



    }

    public function showForm()
    {
        // dd('Create product');
        $data['update_stock'] = false;
        $data['expense'] = false;
        $data['code_info'] = false;
        // $data['update_expense'] = false;


        $data['item_codes'] = DB::table('item_codes')
            ->where('delete_status', '=', '1')
            ->orderBy('id', 'asc')
            ->get();
        $data['category'] = DB::table('categories')
            ->select('*')
            ->where('delete_status', '=', '1')
            ->orderBy('id', 'desc')
            ->get();
        return view('product.add', $data);
    }


    public function getData(string $id)
    {
        $data = DB::table('item_codes')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('item_codes.id', $id)->get()->first();

        $equipment_type = $data->equipment_type == 1 ? __('nav.equipment') : __('nav.accessories');
        return response()->json([
            'data' => $data,
            'equipment_type' => $equipment_type
        ]);
    }

    public function save(Request $request)
    {
        $proImg = '';
        $request->validate([
            "proCode" => 'required|string',
            "model" => 'nullable|string|max:255',
            "serial_number" => 'nullable|string|unique:products,serial_number',
            "fix_asset_code" => 'nullable|string|unique:products,fix_asset_code',
            "qty" => 'required|numeric',
            "descript" => 'nullable|string',
        ]);

        if ($request->hasFile('proImage')) {
            $proImg = $request->file('proImage')->store('uploads/products', 'custom');
        }

        $addBy = Auth::user()->name_en;
        $proCode = $request->proCode;
        $model = $request->model;
        $serial_number = $request->serial_number;
        $fix_asset_code = $request->fix_asset_code;
        $qty     = $request->qty;
        $desctipt = $request->descript;
        // $category = $request->catId;
        // $equipment_type = $request->equipment_type;
        // $proNameKh = $request->proNameKh;
        // $proNameEn = $request->proNameEn;

        $insert = DB::table('products')
            ->insert([
                'pro_img' => $proImg,
                'pro_code' => $proCode,
                'model' => $model,
                'serial_number' => $serial_number,
                'fix_asset_code' => $fix_asset_code,
                'qty' => $qty,
                'pro_description' => $desctipt,
                'year' => date('Y'),
                'add_by' => $addBy,
                'fix_qty' => $qty,
                // 'equipment_type' => $equipment_type
                // 'pro_name_kh' => $proNameKh,
                // 'pro_name_en' => $proNameEn,
                // 'cat_id' => $category,
            ]);

        if ($insert == true) {
            return redirect()->back()->with('success', 'Add item to stock has successfully.');
        }
    }

    public function editFac(string $id)
    {
        $data['products'] = DB::table('products')
            ->select('fix_asset_code')
            ->where('id', $id)->get()->first();

        return response()->json(['data' => $data['products']]);
    }

    public function updateFac(Request $request, string $id)
    {
        $check = DB::table('products')->where('id', $id)->exists();
        if (!$check) {
            return redirect()->back()->with('error', 'Update fix assets has failed.');
        }
        $error = Validator::make($request->all(), [
            'fac' => 'required|string|unique:products,fix_asset_code,' . $id . ',id',
        ]);

        if ($error->fails()) {
            return redirect()->back()->with('error', 'Fix asset has existed.');
        }
        DB::table('products')
            ->where('id', $id)
            ->update(['fix_asset_code' => $request->fac]);
        return redirect()->back()->with('success', 'Update Item Fix asset code has successfully.');
    }

    public function edit($id)
    {
        $data['update_stock'] = true;
        $data['item_codes'] = DB::table('item_codes')
            ->where('delete_status', '=', '1')
            ->orderBy('id', 'asc')
            ->get();

        $data['item'] = Product::find($id);
        $data['code_info'] = DB::table('item_codes')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('item_codes.id', $data['item']->pro_code)
            ->get()->first();

        if ($data['item'] == true) {
            return view('product.add', $data);
        } else {
            return redirect()->back();
        }
    }

    public function doEdit(Request $request, string $id)
    {
        $proImg = '';
        $query = DB::table('products')->where('id', $id)->get()->first();
        if (!$query) {
            return redirect()->back();
        }
        $request->validate([
            "proCode" => 'required|string',
            "model" => 'nullable|string|max:255',
            "serial_number" => 'nullable|string|unique:products,serial_number,' . $id . ',id',
            "fix_asset_code" => 'nullable|string|unique:products,fix_asset_code,' . $id . ',id',
            "qty" => 'required|numeric',
            "fix_qty" => 'required|numeric',
            "descript" => 'nullable|string',
        ]);

        $itemQry = Product::findOrFail($id);

        if ($request->hasFile('proImage')) {
            if (File::exists($itemQry->pro_img)) {
                File::delete($itemQry->pro_img);
            }
            $proImg = $request->file('proImage')->store('uploads/products', 'custom');
        } else {
            $proImg = $query->pro_img;
        }

        // $id = $request->proId;
        // $proImg = $request->file('proImage');
        // $proCode = $request->proCode;
        // $proNameKh = $request->proNameKh;
        // $proNameEn = $request->proNameEn;
        // $model = $request->model;
        // $serial_number = $request->serial_number;
        // $fix_asset_code = $request->fix_asset_code;
        // $category = $request->catId;
        // $qty = $request->qty;
        // $desctipt = $request->descript;
        // $oldImg = $request->oldImg;
        // $imageFile = '';
        // $equipment_type = $request->equipment_type;

        $addBy = Auth::user()->name_en;
        $proCode = $request->proCode;
        $model = $request->model;
        $serial_number = $request->serial_number;
        $fix_asset_code = $request->fix_asset_code;
        $qty     = $request->qty;
        $fix_qty     = $request->fix_qty;
        $desctipt = $request->descript;

        DB::table('products')
            ->where('id', $id)
            ->update([
                'pro_img' => $proImg,
                'model' => $model,
                'serial_number' => $serial_number,
                'fix_asset_code' => $fix_asset_code,
                'pro_code' => $proCode,
                'qty' => $qty,
                'fix_qty' => $fix_qty,
                'pro_description' => $desctipt,
            ]);
        if ($qty > 0) {
            return redirect()->route('product.instock')->with('success', 'Update item has successfully.');
        } else {
            return redirect()->route('product.outstock')->with('success', 'Update item has successfully.');
        }
    }

    public function delete(Request $r)
    {
        $proId = $r->proId;

        $deleteBy = @Auth::user()->name_en;
        $deleteDate = now();
        // $year = date('Y');

        DB::table('products')
            ->where('id', '=', $proId)
            ->update(['delete_status' => '0', 'delete_by' => $deleteBy, 'delete_date' => $deleteDate]);

        return redirect()->back()->with('success', 'Delete item has successfully.');
    }

    public function recovery(Request $r)
    {
        $proId = $r->proId;
        DB::table('products')
            ->where('id', '=', $proId)
            ->update(['delete_status' => '1', 'delete_by' => NULL, 'delete_date' => NULL]);

        return redirect()->back()->with('success', 'Restore item has successfully.');
    }






    // return form
    public function returnDetail(string $id)
    {
        $data['product'] = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                'give_table.return_any_product',
                // 'products.id as proId',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                // 'categories.*'
            )
            ->join('products', 'give_table.product_id', '=', 'products.id')
            // ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', '=', 'section.department_id')
            ->where('give_table.id', $id)
            ->first();

        // Check if productGiven is null
        if (!$data['product']) {
            return redirect()->back();
        }

        // Get product IDs from the given product
        $productIds = explode(',', $data['product']->product_id);
        // foreach($productIds as $id){
        //     echo $id . '<br>';
        // }

        // dd($data['product']);

        // exit;
        // Fetch all products in a single query
        $data['item_infos'] = DB::table('products')
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

        return view('product.return-item', $data);
        // return response()->json([
        //     'message' => true,
        //     'data' => [
        //         'productGiven' => $productGiven,
        //         'relatedProducts' => $products,
        //     ],
        // ]);
    }


    public function doReturn(Request $r)
    {
        // dd($r->input());
        $validate = Validator::make($r->all(), [
            'returnProId' => 'required',
            'givenId' => 'required',
            'attachment' => 'required|image',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Fields are required.');
        }

        $returnAtt = '';

        if ($r->hasFile('attachment')) {
            $returnAtt = $r->file('attachment')->store('uploads/return-atts', 'custom');
        } else {
            $returnAtt = '';
        }

        $givenId = $r->givenId;
        $checkGivenTouser = DB::table('give_table')->where('id', $givenId)->get()->first();
        foreach ($r->returnProId as $proId) {
            // Check the product quantity and ID
            $checkQty = DB::table('products')
                ->select('qty', 'id')
                ->where('id', $proId)
                ->first();

            if ($checkQty) {
                $proQty = $checkQty->qty;
                $updateQty = $proQty + 1;

                // Update product stock and quantity
                DB::table('products')
                    ->where('id', $proId)
                    ->update(['qty' => $updateQty, 'stock_status' => 1]);
            }

            // log return record
            DB::table('product_locks')->insert([
                'product_id' => $proId,
                'return_date' => now(),
                'return_by' => $checkGivenTouser->staff_id,
                'recieve_user' => @Auth::user()->name_kh . ' - ' . @Auth::user()->name_en,
                'return_status' => 1,
            ]);
        }

        $giveProQry = DB::table('give_table')
            ->select('product_id')
            ->where('id', $givenId)
            ->first();

        $productIdFromTable = explode(',', $giveProQry->product_id);
        $productIdFromCheckForm = $r->returnProId;

        // Convert $productIdFromCheckForm to an array if it’s not already
        $array2 = is_array($productIdFromCheckForm) ? $productIdFromCheckForm : explode(',', $productIdFromCheckForm);

        $array1 = $productIdFromTable;

        $notSameValues = [];
        $SameValues = [];

        // Find values not in the other array
        foreach ($array1 as $value1) {
            if (!in_array($value1, $array2)) {
                $notSameValues[] = $value1;
            } else {
                $SameValues[] = $value1;
            }
        }

        foreach ($array2 as $value2) {
            if (!in_array($value2, $array1)) {
                $notSameValues[] = $value2;
            }
        }

        // Prepare results for output
        $storInprocut_id = implode(',', $notSameValues);
        $storeInreturnAnyProduct = implode(',', $SameValues);


        // update return here
        if (empty($notSameValues)) {
            DB::table('give_table')
                ->where('id', $givenId)
                ->update([
                    'return_status' => 0,
                    'any_return_status' => 0,
                    'return_any_product' => $storeInreturnAnyProduct,
                    'returned_date' => now(),
                    'return_attachment' => $returnAtt,
                ]);
            // echo 'Update returned';
        } else {
            // echo 'Not return this ';
            DB::table('give_table')
                ->where('id', $givenId)
                ->update([
                    'product_id' => $storInprocut_id,
                    'any_return_status' => 0,
                    'return_any_product' => $storeInreturnAnyProduct,
                    'returned_date' => now(),
                    'return_attachment' => $returnAtt,
                ]);
            // echo 'Update any return';
        }
        return redirect()->route('product.returned')->with('success', 'Return item has successfully.');
    }


    public function returned()
    {
        $data['product'] = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                'give_table.add_by as operator',
                // 'products.pro_img',
                // 'products.pro_name_en',
                // 'products.pro_name_kh',
                // 'products.pro_code',
                'products.id as proId',
                // 'products.model',
                // 'products.fix_asset_code',
                // 'products.serial_number',
                'users.*',
                'positions.*',
                'section.*',
                'departments.*',
                // 'categories.*'
            )
            ->where('give_table.any_return_status', 0)
            ->join('products', 'give_table.product_id', '=', 'products.id')
            // ->join('categories', 'products.cat_id', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('give_table.returned_date', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();
        return view('product.returned', $data);
    }

    public function returnedDetail(string $id)
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
        $productGivenAll = explode(',', $productGiven->constant_proid);
        // array not in
        $ProductIdHasReturn = array_diff($productGivenAll, $productIds);

        // Fetch all products in a single query
        if ($productGiven->return_status == 1) {
            $products = DB::table('products')
                ->select(
                    'products.*',
                    'products.id as proId',
                    'products.model',
                    'item_codes.*',
                    'categories.*'
                )
                ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
                ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
                // ->whereIn('products.id', $productIds)
                ->whereIn('products.id', $ProductIdHasReturn)->get();
        } else {
            $products = DB::table('products')
                ->select(
                    'products.*',
                    'products.id as proId',
                    'products.model',
                    'item_codes.*',
                    'categories.*'
                )
                ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
                ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
                // ->whereIn('products.id', $productIds)
                ->whereIn('products.id', $productGivenAll)->get();
        }
        $gender = strtolower($productGiven->gender);
        $id_card = $productGiven->card_id ?? __('nav.newStaff');
        return response()->json([
            'message' => true,
            'data' => [
                'giveDate' => Carbon::parse($productGiven->date)->format('d M Y'),
                'returnedDate' => Carbon::parse($productGiven->returned_date)->format('d M Y h:i:s A'),
                'productGiven' => $productGiven,
                'relatedProducts' => $products,
                'gender' => __('nav.' . $gender),
                'card_id' => $id_card,
            ],
        ]);
    }





    // export product instock lists
    public function exportInstock()
    {
        return Excel::download(new ProductInstockExport, 'item-stock-in-' . now()->format("d-m-Y__h-i-s") . '.xlsx');
    }

    // export product outstock lists
    public function exportOutstock()
    {
        return Excel::download(new ProductOutstockExport, 'item-stock-out-' . now()->format("d-m-Y__h-i-s") . '.xlsx');
    }

    public function exportStatistic()
    {
        return Excel::download(new ProductStatisticExport, 'item-statistic-' . now()->format("d-m-Y__h-i-s") . '.xlsx');
    }



    // export product has returned
    // export given product
    public function hasReturnedExportExcel()
    {
        $filename = 'item-returned-list-' . now()->format('d-m-Y_h-i-s_a') . '.xlsx';
        return Excel::download(new ProductHasReturnedExport, $filename);
    }


    public function exportInstockPdf()
    {
        $products = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'item_codes.item_code', 'item_codes.item_name_kh', 'item_codes.item_name_en')
            ->where('products.stock_status', 1)
            ->where('products.qty', '>=', '1')
            ->where('products.delete_status', 1)
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.id', 'desc')->get();

        $html = view('pdf.item-instock', ['items' => $products, 'title' => __("nav.productInStock")])->render();
        return PdfKh::loadHtml($html)
            ->addMPdfConfig([
                'mode' => 'utf-8',
                'format' => 'A4-L',
            ])
            ->download('item-stock-in-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }

    public function exportOutstockPdf()
    {
        $products = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'item_codes.item_code', 'item_codes.item_name_kh', 'item_codes.item_name_en')
            ->where('products.stock_status', 0)
            ->where('products.qty', '<=', '0')
            ->where('products.delete_status', 1)
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.id', 'desc')->get();

        $html = view('pdf.item-instock', ['items' => $products, 'title' => __("nav.productOutstock")])->render();
        return PdfKh::loadHtml($html)
            ->addMPdfConfig([
                'mode' => 'utf-8',
                'format' => 'A4-L',
            ])
            ->download('item-stock-out-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }

    public function exportStatisticPdf()
    {
        $item_codes = DB::table('item_codes')
            ->where('delete_status', 1)
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($item_code) {
                $item_code->total_qty = DB::table('products')
                    ->where('pro_code', $item_code->id)
                    ->where('delete_status', 1)
                    // ->where('year', $currentYear)
                    ->sum('fix_qty');
                return $item_code;
            });

        $html = view('pdf.statistic', ['item_code_counts' => $item_codes, 'title' => __("nav.statistic")])->render();
        return PdfKh::loadHtml($html)
            ->addMPdfConfig([
                'mode' => 'utf-8',
                'format' => 'A4-P',
            ])
            ->download('item-statistic-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }

    ///////// Trash bin export

    public function exportTrashbinExcel()
    {
        return Excel::download(new ItemTrashbinExport, 'item-in-trash-' . now()->format("d-m-Y__h-i-s") . '.xlsx');
    }

    public function exportTrashbinPdf()
    {
        $products = DB::table('products')
            ->select('products.*', 'categories.cat_name', 'item_codes.item_code', 'item_codes.item_name_kh', 'item_codes.item_name_en')
            ->where('products.delete_status', 0)
            ->join('item_codes', 'products.pro_code', '=', 'item_codes.id')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('products.id', 'desc')->get();

        $html = view('pdf.item-instock', ['items' => $products, 'title' => __("nav.trashbin")])->render();
        return PdfKh::loadHtml($html)
            ->addMPdfConfig([
                'mode' => 'utf-8',
                'format' => 'A4-L',
            ])->download('item-in-trash-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }


    public function hasReturnedExportPdf()
    {
        $productReturned = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
                'give_table.add_by as operator',
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
            ->where('give_table.any_return_status', 0)
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('categories', 'products.cat_id', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('positions', 'positions.id', '=', 'users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', 'section.department_id')
            ->orderBy('give_table.returned_date', 'desc')->get();

        $html = view('pdf.item-returned', ['productReturneds' => $productReturned, 'title' => __("nav.returnedList")])->render();
        return PdfKh::loadHtml($html)
            ->addMPdfConfig([
                'mode' => 'utf-8',
                'format' => 'A4-L',
            ])
            ->download('item-has-returned-list-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
