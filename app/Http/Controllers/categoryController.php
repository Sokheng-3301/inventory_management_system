<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
// use App\Http\Controllers\use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

// use DB;

class categoryController extends Controller
{
    // Login Authentication
    public function __construct()
    {
        $this->middleware('auth');

        // exit;
        // $checkFunction = DB::table('apply_funcion_for_role')
        //     ->where('role_id', @Auth::user()->role_id)->get()->first();

        // if ($checkFunction) {
        //     $subFunction = explode(',', $checkFunction->sub_function_id);
        //     if (!in_array(1, $subFunction)) {
        //         return redirect()->back();
        //     }
        // }
    }
/*
    public function welcome()
    {
        $items = 0;
        $coutn_items = DB::table('products')->where('delete_status', 1)->where('year', date('Y'))->where('stock_status', 1)->get();
        foreach ($coutn_items as $c_item) {
            $items += $c_item->fix_qty;
        }
        $data['instock'] = $items;


        $data['outstock'] = DB::table('products')
            ->where('stock_status', 0)
            ->get();


        $data['overdraft']  = DB::table('borrows')
            ->join('users', 'users.card_id', 'borrows.staff_id')
            ->join('products', 'products.id', 'borrows.pro_id')

            ->where('borrows.borrow_status', 1)
            ->where('borrows.payback_status', 2)
            ->orderBy('borrows.borrow_id', 'desc')
            ->limit(6)
            ->get();

        $data['notification'] = DB::table('borrows')
            ->join('users', 'users.card_id', 'borrows.staff_id')
            ->join('products', 'products.id', 'borrows.pro_id')
            ->where('borrows.borrow_status', 0)
            ->orWhere('borrows.notification', 1)
            ->orderBy('borrows.borrow_id', 'desc')
            ->limit(6)
            ->get();

        $data['blocked_account'] = DB::table('users')
            ->join('staff_users', 'users.card_id', 'staff_users.card_id')
            ->join('positions', 'staff_users.position', 'positions.id')
            ->where('users.block_status', 0)
            ->get();

        $given_item = 0;
        $query = DB::table('give_table')->where('return_status', 1)->where('year', date('Y'))->get();

        foreach ($query as $q) {
            $product_alls = $q->product_id;
            $exp_pro_alls = explode(',', $product_alls);
            $length = count($exp_pro_alls);
            $given_item += $length;
        }
        $data['given_item'] = $given_item;


        return view('welcome', $data);
    }
*/
    public function index()
    {
        $data['category'] = DB::table('categories')
            ->orderBy('delete_status', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        return view("category.list", $data);
    }

    public function create(Request $request)
    {
        $category = $request->categoryName;
        if ($category == "") {
            session()->flash("error", 'Please enter category name.');
            return redirect(route("category.list"));
        } else {
            $addBy = @Auth::user()->name_en;
            $year = date('Y');
            DB::table("categories")->insert([
                'cat_name' => $category,
                'add_by' => $addBy,
                'year' => $year,
            ]);
            return redirect()->back()->with('success', 'Create category has successfully.');
        }
    }

    public function update(Request $r)
    {
        $catId = $r->catId;
        $category = $r->categoryName;
        if (($category && $catId) != NULL) {
            DB::table('categories')
                ->where('id', $catId)
                ->update(['cat_name' => $category,]);

            return redirect()->back()->with('success', 'Update category has successfully.');
        } else {
            return redirect()->back()->with('error', 'Please enter category name.');
        }
    }

    public function delete(Request $r)
    {
        $catId = $r->catId;

        $deleteBy = 'Admin';
        $deleteDate = now();
        // $year = date('Y');

        DB::table('categories')
            ->where('id', '=', $catId)
            ->update(['delete_status' => '0', 'delete_by' => $deleteBy, 'delete_date' => $deleteDate]);

        return redirect()->back()->with('success', 'Delete category has successfully.');
    }

    public function recovery(Request $r)
    {
        $catId = $r->catId;
        DB::table('categories')
            ->where('id', '=', $catId)
            ->update(['delete_status' => '1', 'delete_by' => NULL, 'delete_date' => NULL]);
        return redirect()->back()->with('success', 'Restore category has successfully.');
    }


    public function export()
    {
        return Excel::download(new CategoryExport, 'category-' . now()->format('d-m-Y__h-i-s') . '.xlsx');
    }

    public function exportPdf()
    {
        $category = DB::table('categories')
            ->where('delete_status', 1)
            ->orderBy('id', 'desc')->get();
        $html = view('pdf.category', ['categories' => $category, 'title' => __("nav.category")])->render();
        return PdfKh::loadHtml($html)->download('category-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
