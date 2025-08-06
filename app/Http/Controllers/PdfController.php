<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function index()
    {
        // Load the Blade view
        $pdf = Pdf::loadView('pdf.pdf');

        // Download the PDF
        return $pdf->download('khmer-document.pdf');
    }
}