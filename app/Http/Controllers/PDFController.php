<?php

namespace App\Http\Controllers;

use App\PerseroanCommanditer;
use App\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PDFController extends Controller
{
    public function generatePDF ($idUser, $idPesanan) {
        $user = User::where('id', $idUser)->get()->first();
        $pesanan = PerseroanCommanditer::where('id', $idPesanan)->get()->first();
        $data = ['title' => 'Welcome to belajarphp.net'];
        $html = view('admin.pdf', ['user' => $user, 'pesanan' => $pesanan]);

        $pdf = App::make('dompdf.wrapper');
        $downloadData = $pdf->loadHTML($html);
        return $pdf->download('laporan-pdf.pdf');
    }
}
