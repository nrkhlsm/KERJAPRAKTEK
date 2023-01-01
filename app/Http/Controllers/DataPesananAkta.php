<?php

namespace App\Http\Controllers;

use App\AkteJualBeli;
use App\PerseroanCommanditer;
use App\PerseroanTerbatas;
use Illuminate\Http\Request;

class DataPesananAkta extends Controller
{
    public function jualBeli() {
        $data = AkteJualBeli::with('user')->get();
        return view('admin.pages.data-pesanan.jualbeli')->with(['data' => $data]);
    }

    public function komanditer() {
        $data = PerseroanCommanditer::with('user')->get();
        return view('admin.pages.data-pesanan.komanditer')->with(['data' => $data]);
    }

    public function terbatas() {
        $data = PerseroanTerbatas::with('user')->get();
        return view('admin.pages.data-pesanan.terbatas')->with(['data' => $data]);
    }

}
