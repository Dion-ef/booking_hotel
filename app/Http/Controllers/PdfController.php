<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Riwayat;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function cetakPdf()
    {
        $riwayat = Riwayat::all();

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Instansiasi Dompdf dengan opsi yang telah dikonfigurasi
        $dompdf = new Dompdf($options);

        // Load view blade ke Dompdf
        $html = view('admin.pdf', compact('riwayat'));
        $dompdf->loadHtml($html);

        // Rendering PDF
        $dompdf->render();

        // Output PDF ke browser
        return $dompdf->stream('pama_hotel_riwayat.pdf');
    }
    public function pdf(){
        $riwayat = Riwayat::all();
        return view('admin.pdf', compact('riwayat'));
    }

}
