<?php

namespace App\Http\Controllers;

use App\Exports\ItemCodeExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

class ItemCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        $data['item_codes'] = DB::table('item_codes')
            ->select('item_codes.*', 'item_codes.id as item_code_id', 'item_codes.delete_status as deleteStatus', 'categories.id', 'categories.cat_name')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->orderBy('item_codes.id', 'asc')->get();
        return view('item-code.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        $data['categorys'] = DB::table('categories')->where('delete_status', '1')->orderBy('cat_name', 'asc')->get();
        return view('item-code.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $request->validate([
            'item_code' => 'required|string|unique:item_codes,item_code',
            'item_name_kh' => 'required|string|max:255',
            'item_name_en' => 'required|string|max:255',
            'item_cat' => 'required|string|max:255',
            'equipment_type' => 'required|string|max:255',
        ]);


        $insert = DB::table('item_codes')
            ->insert([
                'item_code' => $request->item_code,
                'item_name_kh' => $request->item_name_kh,
                'item_name_en' => $request->item_name_en,
                'item_cat' => $request->item_cat,
                'equipment_type' => $request->equipment_type,
            ]);
        if ($insert == true) {
            return redirect()->back()->with('success', 'Create Item Code has successfully.');
        } else {
            return redirect()->back()->with('error', 'Create Item Code has failed.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $data['categorys'] = DB::table('categories')->where('delete_status', '1')->orderBy('cat_name', 'asc')->get();
        $data['item'] = DB::table('item_codes')
            ->select('item_codes.*', 'item_codes.id as item_code_id', 'categories.*')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('item_codes.id', $id)
            ->get()->first();
        if ($data['item']) {
            return view('item-code.add', $data);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->input());
        $data['item'] = DB::table('item_codes')
            ->where('id', $id)->exists();
        if (!$data['item']) {
            return redirect()->back();
        }

        $request->validate([
            'item_code' => 'required|string|unique:item_codes,item_code,' . $id . ',id',
            'item_name_kh' => 'required|string|max:255',
            'item_name_en' => 'required|string|max:255',
            'item_cat' => 'required|string|max:255',
            'equipment_type' => 'required|string|max:255',
        ]);


        DB::table('item_codes')
            ->where('id', $id)
            ->update([
                'item_code' => $request->item_code,
                'item_name_kh' => $request->item_name_kh,
                'item_name_en' => $request->item_name_en,
                'item_cat' => $request->item_cat,
                'equipment_type' => $request->equipment_type,
            ]);

        return redirect()->route('item_code.index')->with('success', 'Update Item Code has successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $item = DB::table('item_codes')
            ->where('id', $id)->get()->first();

        if ($item->delete_status == 0) {
            DB::table('item_codes')
                ->where('id', $id)
                ->update([
                    'delete_status' => 1,
                ]);
            return redirect()->route('item_code.index')->with('success', 'Restore Item Code has successfully.');
        } else {
            DB::table('item_codes')
                ->where('id', $id)
                ->update([
                    'delete_status' => 0,
                    'deleted_by' => Auth::user()->name_en,
                    'deleted_date' => now(),
                ]);
            return redirect()->route('item_code.index')->with('success', 'Delete Item Code has successfully.');
        }
    }

    public function exportExcel()
    {
        return Excel::download(new ItemCodeExport, 'item-code-' . now()->format('d-m-Y__h-i-s') . '.xlsx');
    }

    public function exportPdf()
    {
        $item_codes = DB::table('item_codes')
            ->select('item_codes.*', 'item_codes.id as item_code_id', 'item_codes.delete_status as deleteStatus', 'categories.id', 'categories.cat_name')
            ->join('categories', 'item_codes.item_cat', '=', 'categories.id')
            ->where('item_codes.delete_status', 1)
            ->orderBy('item_codes.item_code', 'asc')->get();
        $html = view('pdf.item-code', ['item_codes' => $item_codes, 'title' => __("nav.itemCode")])->render();
        return PdfKh::loadHtml($html)->download('item-code-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
