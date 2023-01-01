<?php

namespace App\Http\Controllers;

use App\AkteJualBeli;
use App\PerseroanCommanditer;
use App\PerseroanTerbatas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \phpseclib\Crypt\RSA;
use \phpseclib\Crypt\RSA as Crypt_RSA;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $jualbeli = AkteJualBeli::all();
        $terbatas = PerseroanTerbatas::all();
        $komanditer = PerseroanCommanditer::all();

        if (Auth::user()->hasRole('pemohon')) {
            $jualbeli = AkteJualBeli::where('user_id', Auth::user()->id)->get();
            $terbatas = PerseroanTerbatas::where('user_id', Auth::user()->id)->get();
            $komanditer = PerseroanCommanditer::where('user_id', Auth::user()->id)->get();
            return view('pemohon.dashboard')->with(['user' => $user, 'jualbeli' => $jualbeli, 'terbatas' => $terbatas, 'komanditer' => $komanditer]);
        } else if (Auth::user()->hasRole('admin')) {
            return view('admin.dashboard')->with(['user' => $user, 'jualbeli' => $jualbeli, 'terbatas' => $terbatas, 'komanditer' => $komanditer]);
        }
    }
}
