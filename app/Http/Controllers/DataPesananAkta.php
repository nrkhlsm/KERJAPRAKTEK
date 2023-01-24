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
    public function jualBeli()
    {
        $data = AkteJualBeli::with('user')->get();
        return view('admin.pages.data-pesanan.jualbeli')->with(['data' => $data]);
    }

    public function komanditer()
    {
        $data = PerseroanCommanditer::with('user')->get();
        return view('admin.pages.data-pesanan.komanditer')->with(['data' => $data]);
    }

    public function terbatas()
    {
        $data = PerseroanTerbatas::with('user')->get();
        $userAdmin = User::with('model_has_role')->where('id', Auth::id())->first();

        return view('admin.pages.data-pesanan.terbatas')->with(['data' => $data, 'userAdmin' => $userAdmin]);
    }

    public function cetakTerbatas(Request $request)
    {
        $request->validate(
            [
                'dateStart' => 'required',
                'dateEnd' => 'required',
            ]
        );

        $user = User::with('model_has_role')->where('id', Auth::id())->first();

        //notaris
        if ($user->model_has_role->model_id == 1) {
            return redirect()->back();
        }

        $dateNowWithoutTime = date('d-m-Y');

        $PerseroanTerbatas = PerseroanTerbatas::whereDate('created_at', '>=', $request->dateStart)
            ->whereDate('created_at', '<=', $request->dateEnd)
            ->get()
            ->toArray();

        $pdf = PDF::loadView('laporan.perseroan_terbatas', ['PerseroanTerbatas' => $PerseroanTerbatas, 'user' => $user->toArray(), 'dateStart' => $request->dateStart, 'dateEnd' => $request->dateEnd, 'dateNowWithoutTime' => $dateNowWithoutTime]);
        return $pdf->stream('Perseroan terbatas.pdf');
    }

    public function cetakCommanditer(Request $request)
    {
        $request->validate(
            [
                'dateStart' => 'required',
                'dateEnd' => 'required',
            ]
        );

        $user = User::with('model_has_role')->where('id', Auth::id())->first();

        //notaris
        if ($user->model_has_role->model_id == 1) {
            return redirect()->back();
        }

        $dateNowWithoutTime = date('d-m-Y');

        $perseroanCommanditer = PerseroanCommanditer::whereDate('created_at', '>=', $request->dateStart)
            ->whereDate('created_at', '<=', $request->dateEnd)
            ->get()
            ->toArray();

        $pdf = PDF::loadView('laporan.perseroan_commanditer', ['perseroanCommanditer' => $perseroanCommanditer, 'user' => $user->toArray(), 'dateStart' => $request->dateStart, 'dateEnd' => $request->dateEnd, 'dateNowWithoutTime' => $dateNowWithoutTime]);

        return $pdf->stream('Perseroan commanditer.pdf');
    }

    public function cetakJualBeli(Request $request)
    {
        $request->validate(
            [
                'dateStart' => 'required',
                'dateEnd' => 'required',
            ]
        );

        $user = User::with('model_has_role')->where('id', Auth::id())->first();

        //notaris
        if ($user->model_has_role->model_id == 1) {
            return redirect()->back();
        }

        $dateNowWithoutTime = date('d-m-Y');

        $akteJualBeli = AkteJualBeli::with('user')
            ->whereDate('created_at', '>=', $request->dateStart)
            ->whereDate('created_at', '<=', $request->dateEnd)
            ->get()
            ->toArray();

        $pdf = PDF::loadView('laporan.jual_beli', ['akteJualBeli' => $akteJualBeli, 'user' => $user->toArray(), 'dateStart' => $request->dateStart, 'dateEnd' => $request->dateEnd, 'dateNowWithoutTime' => $dateNowWithoutTime]);

        return $pdf->stream('Akta jual beli.pdf');
    }
}
