<?php

namespace App\Http\Controllers;

use App\Exports\ServiceFeeExport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;
use Illuminate\Support\Facades\Validator;

class ServiceFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', @Auth::user()->role_id)
            ->get()->first();

        if ($request) {
            $year = $request->year;
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }

        $query = DB::table('service_fees')->orderBy('id', 'desc');

        if ($year != '' && empty($start_date) && empty($end_date)) {
            $data['service_fees'] = $query->where('year', $year)->get();
        } elseif ($year != '' && $start_date && empty($end_date)) {
            $data['service_fees'] = $query->whereBetween('date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                now()->format('Y-m-d'),
            ])->get();
        } elseif ($year != '' && $start_date && $end_date) {
            $data['service_fees'] = $query->whereBetween('date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                Carbon::parse($end_date)->format('Y-m-d'),
            ])->get();
        } else {
            $data['service_fees'] = $query->where('year', date('Y'))->get();
        }

        return view('service-fee.expense', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        return view('service-fee.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $attachment = '';
        $validate = Validator::make($request->all(), [
            'date' => 'required',
            'price' => 'required|numeric|min:0',
            'note' => 'required|string|max:500',
            'attachment' => 'required|image', // Optional: limit file types and size
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Validate has failed!')->withInput();
        }

        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment')->store('uploads/service-atts', 'custom');
        }

        $insert = DB::table('service_fees')
            ->insert([
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'price' => $request->price,
                'note' => $request->note,
                'year' => date('Y'),
                'attachment' => $attachment,
                'add_by' => Auth::user()->name_en,
            ]);

        if ($insert == true) {
            return redirect()->back()->with('success', 'Create expense service fee has successfully.');
        } else {
            return redirect()->back()->with('error', 'Create expense service fee has failed.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = DB::table('service_fees')->where('id', $id)->get()->first();
        return response()->json([
            'data' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $data['item'] = DB::table('service_fees')->where('id', $id)->get()->first();
        $referer = request()->headers->get('referer');
        $data['queryString'] = parse_url($referer, PHP_URL_QUERY);

        if (!$data['item']) {
            return redirect()->back();
        } else {
            return view('service-fee.add', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->input());
        $query_string = $request->query_string;
        $item = DB::table('service_fees')->where('id', $id)->get()->first();

        $attachment = '';
        $validate = Validator::make($request->all(), [
            'date' => 'required',
            'price' => 'required|numeric|min:0',
            'note' => 'required|string|max:500',
            'attachment' => 'nullable|image', // Optional: limit file types and size
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Validate has failed!')->withInput();
        }

        if ($request->hasFile('attachment')) {
            if (File::exists($item->attachment)) {
                File::delete($item->attachment);
            }
            $attachment = $request->file('attachment')->store('uploads/service-atts', 'custom');
        } else {
            $attachment = $item->attachment;
        }

        DB::table('service_fees')
            ->where('id', $id)
            ->update([
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'price' => $request->price,
                'note' => $request->note,
                'year' => date('Y'),
                'attachment' => $attachment,
                'add_by' => Auth::user()->name_en,
            ]);

        return redirect()->route('expense.service.index', $query_string)->with('success', 'Update expense service fee has successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function exportExcel(Request $request)
    {
        $filename = 'expenses-service-fee-' . now()->format('d-m-Y_h-i-s_a') . '.xlsx';
        return Excel::download(new ServiceFeeExport(
            $request->year,
            $request->start_date,
            $request->end_date
        ), $filename);
    }

    public function exportPdf(Request $request)
    {
        if ($request) {
            $year = $request->year;
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }

        $query = DB::table('service_fees')->orderBy('id', 'desc');

        if ($year != '' && empty($start_date) && empty($end_date)) {
            $data['service_fees'] = $query->where('year', $year)->get();
        } elseif ($year != '' && $start_date && empty($end_date)) {
            $data['service_fees'] = $query->whereBetween('date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                now()->format('Y-m-d'),
            ])->get();
        } elseif ($year != '' && $start_date && $end_date) {
            $data['service_fees'] = $query->whereBetween('date', [
                Carbon::parse($start_date)->format('Y-m-d'),
                Carbon::parse($end_date)->format('Y-m-d'),
            ])->get();
        } else {
            $data['service_fees'] = $query->where('year', date('Y'))->get();
        }


        $html = view('pdf.service-fee', ['items' => $data['service_fees'], 'title' => __("nav.serviceFee")])->render();
        return PdfKh::loadHtml($html)->addMPdfConfig([
            'format' => 'A4-L',
        ])->download('expenses-service-fee-' . now()->format('d-m-Y__h-i-s') . '.pdf');
    }
}
