<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use PDF;
// use TCPDF;

use Dompdf\Dompdf;
use Dompdf\Options;


class ExportdataController extends Controller
{
    public function index(Request $request)
    {
        // Format the filename without colons
        $filename = 'backup-data-' . date('d-m-Y__h-i-s-a') . '.sql';
        // Run the artisan command
        $run = Artisan::call('db:export', ['filename' => $filename]);

        return redirect()->back()->with('success', 'Export backup data as SQL has successfully.');
    }


    // public function exportPdf() {
    //     // Fetch product data
    //     $data['product'] = DB::table('give_table')
    //         ->select(
    //             'give_table.*',
    //             'give_table.id as giveId',
    //             'give_table.return_any_product',
    //             'products.pro_img',
    //             'products.pro_name_en',
    //             'products.pro_name_kh',
    //             'products.pro_code',
    //             'products.id as proId',
    //             'products.model',
    //             'products.fix_asset_code',
    //             'products.serial_number',
    //             'users.*',
    //             'staff_users.*',
    //             'positions.*',
    //             'section.*',
    //             'departments.*',
    //             'categories.*'
    //         )
    //         ->where('give_table.return_status', 1)
    //         ->where('give_table.year', date('Y'))
    //         ->join('products', 'give_table.product_id', '=', 'products.id')
    //         ->join('categories', 'products.cat_id', '=', 'categories.id')
    //         ->join('users', 'give_table.staff_id', '=', 'users.id')
    //         ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id')
    //         ->join('positions', 'positions.id', '=', 'staff_users.position')
    //         ->join('section', 'positions.section_id', '=', 'section.id')
    //         ->join('departments', 'departments.id', '=', 'section.department_id')
    //         ->orderBy('give_table.id', 'desc')
    //         ->get();
    
    //     // Fetch action data
    //     $data['action'] = DB::table('apply_funcion_for_role')
    //         ->where('role_id', Auth::user()->role_id)
    //         ->first();

    //     $pdf = PDF::loadView('product.given-pdf', $data);
    //     return $pdf->setPaper('a4')->stream('document.pdf');
    //     // // Create PDF
    //     // $pdf = new TCPDF();
    //     // $pdf->AddPage();
    
    //     // // Set Khmer font
    //     // $fontPath = storage_path('fonts/Khmer-Regular.ttf');
    //     // $pdf->AddFont('Khmer', '', $fontPath, true);
    //     // $pdf->SetFont('Khmer', '', 12);
    
    //     // // Render HTML view
    //     // $html = view('product.given-pdf', $data)->render();
    //     // $pdf->writeHTML($html, true, false, true, false, '');
    
    //     // // Output PDF
    //     // return $pdf->Output('data.pdf', 'D');
    // }


    
    public function exportPdf() {
        // Fetch product data
        $data['product'] = DB::table('give_table')
            ->select(
                'give_table.*',
                'give_table.id as giveId',
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
                'staff_users.*',
                'positions.*',
                'section.*',
                'departments.*',
                'categories.*'
            )
            ->where('give_table.return_status', 1)
            ->where('give_table.year', date('Y'))
            ->join('products', 'give_table.product_id', '=', 'products.id')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->join('users', 'give_table.staff_id', '=', 'users.id')
            ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id')
            ->join('positions', 'positions.id', '=', 'staff_users.position')
            ->join('section', 'positions.section_id', '=', 'section.id')
            ->join('departments', 'departments.id', '=', 'section.department_id')
            ->orderBy('give_table.id', 'desc')
            ->get();
    
        // Fetch action data
        $data['action'] = DB::table('apply_funcion_for_role')
            ->where('role_id', Auth::user()->role_id)
            ->first();
    
        // Create PDF
        $pdf = PDF::loadView('product.given-pdf', $data);
        // return $pdf->setPaper('a4')->stream('document.pdf');
        return $pdf->setPaper('a4', 'landscape')->stream('Given-list.pdf');

    }





    // public function exportPdf() {
        
    // }

    /*
        public function exportPdf()
        {
            $options = new Options();
            $options->set('defaultFont', 'KhmerOS');
            $options->set('debugKeepTemp', true);
            $options->set('debugFontSize', true);
            
            $dompdf = new Dompdf($options);
            $data['product'] = DB::table('give_table')
                            ->select(
                                'give_table.*',
                                'give_table.id as giveId',
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
                                'staff_users.*',
                                'positions.*',
                                'section.*',
                                'departments.*',
                                'categories.*'
                            )
                            ->where('give_table.return_status', 1)
                            ->where('give_table.year', date('Y'))
                            ->join('products', 'give_table.product_id', '=', 'products.id')
                            ->join('categories', 'products.cat_id', '=', 'categories.id')
                            ->join('users', 'give_table.staff_id', '=', 'users.id')
                            ->join('staff_users', 'users.card_id', '=', 'staff_users.card_id')
                            ->join('positions', 'positions.id', '=', 'staff_users.position')
                            ->join('section', 'positions.section_id', '=', 'section.id')
                            ->join('departments', 'departments.id', '=', 'section.department_id')
                            ->orderBy('give_table.id', 'desc')
                            ->get();
        
            // Fetch action data
            $data['action'] = DB::table('apply_funcion_for_role')
                            ->where('role_id', Auth::user()->role_id)
                            ->first();

            $pdf = PDF::loadView('product.given-pdf', $data);
            $dompdf->loadHtml($pdf);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('document.pdf', ['Attachment' => true]);
        
        }
    */
}