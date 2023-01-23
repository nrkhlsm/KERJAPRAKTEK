<?php

namespace App\Http\Controllers;

use App\AkteJualBeli;
use App\PerseroanCommanditer;
use App\PerseroanTerbatas;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;

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
        $userAdmin = User::with('model_has_role')->where('id', Auth::id())->first();

        return view('admin.pages.data-pesanan.terbatas')->with(['data' => $data, 'userAdmin'=> $userAdmin]);
    }

    public function cetakTerbatas()
    {
        $user = User::with('model_has_role')->where('id', Auth::id())->first();

        //notaris
        if($user->model_has_role->model_id == 1){
            return redirect()->back();    
        }

        $dateNow = date('d-m-Y H:i:s');  
        $PerseroanTerbatas = PerseroanTerbatas::all()->toArray();
        $pdf = PDF::loadView('laporan.perseroan_terbatas', ['PerseroanTerbatas'=>$PerseroanTerbatas, 'user'=> $user->toArray(), 'dateNow' => $dateNow]);
        return $pdf->stream('commanditer.pdf');
    }

    public function cetakCommanditer()
    {
        $user = User::with('model_has_role')->where('id', Auth::id())->first();

        //notaris
        if($user->model_has_role->model_id == 1){
            return redirect()->back();    
        }
        
        $dateNow = date('d-m-Y H:i:s');  
        $perseroanCommanditer = PerseroanCommanditer::all()->toArray();
        $pdf = PDF::loadView('laporan.perseroan_commanditer', ['perseroanCommanditer'=>$perseroanCommanditer, 'user'=> $user->toArray(), 'dateNow' => $dateNow]);
        return $pdf->stream('commanditer.pdf');
    }

    public function cetakJualBeli()
    {
        $user = User::with('model_has_role')->where('id', Auth::id())->first();

        //notaris
        if($user->model_has_role->model_id == 1){
            return redirect()->back();    
        }
        
        $dateNow = date('d-m-Y H:i:s');  
        $akteJualBeli = AkteJualBeli::all()->toArray();
        $pdf = PDF::loadView('laporan.jual_beli', ['akteJualBeli'=>$akteJualBeli, 'user'=> $user->toArray(), 'dateNow' => $dateNow]);
        return $pdf->stream('commanditer.pdf');
    }

}
