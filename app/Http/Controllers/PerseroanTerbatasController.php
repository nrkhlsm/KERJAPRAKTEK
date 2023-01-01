<?php

namespace App\Http\Controllers;

use App\PerseroanTerbatas;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Image;

use \phpseclib\Crypt\RSA;
use \phpseclib\Crypt\RSA as Crypt_RSA;

class PerseroanTerbatasController extends Controller
{
    public $path;
    public function __construct()
    {
        $this->path = storage_path('app/public/documents');
    }
    public function index()
    {
        $data = PerseroanTerbatas::all();
        return view('pemohon.sidebar.perseroan_terbatas.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemohon.sidebar.perseroan_terbatas.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_pt' => 'required',
            'alamat' => 'required'
        ]);

        $user = User::find(Auth::user()->id);

        // if (!File::isDirectory($this->path)) {
        //     File::makeDirectory($this->path);
        // }
        // if (!File::isDirectory($this->path . '/' . $user->id)) {
        //     File::makeDirectory($this->path . '/' . $user->id);
        // }
        // if (!File::isDirectory($this->path . '/' . $user->id . '/perseroanterbatas')) {
        //     File::makeDirectory($this->path . '/' . $user->id . '/perseroanterbatas');
        // }
        // $originalPath = $this->path . '/' . $user->id . '/perseroanterbatas' . '/';

        $ktp_pihak_satu = $request->file('ktp');
        $ktp_pihak_satu_image = Image::make($ktp_pihak_satu);
        $ktp_pihak_satu_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $ktp_pihak_satu->getClientOriginalName();
        $ktp_pihak_satu_image->save('asset/ktp/' . $ktp_pihak_satu_name);

        $npwp = $request->file('npwp');
        $npwp_image = Image::make($npwp);
        $npwp_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $npwp->getClientOriginalName();
        $npwp_image->save('asset/npwp/' . $npwp_name);

        $legalitas = $request->file('legalitas');
        $legalitas_image = Image::make($legalitas);
        $legalitas_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $legalitas->getClientOriginalName();
        $legalitas_image->save('asset/legal/' . $legalitas_name);


        ################ start encrypt ################
        // set key
        $rsa = $rsa = new RSA();
        $keys = $rsa->createKey(4096);
        $publicKey = $keys['publickey'];
        $privateKey = $keys['privatekey'];

        // encrypt proses
        $enk = new Crypt_RSA();
        $enk->loadKey($publicKey);
        $enk->setEncryptionMode(2);
        
        // start proses encrpyt ktp
        $ktp_binary = file_get_contents('asset/ktp/' . $ktp_pihak_satu_name);
        $data_ktp = $ktp_binary;
        $enkripsi_ktp = $enk->encrypt($data_ktp);
        
        unlink('asset/ktp/' . $ktp_pihak_satu_name);
        file_put_contents('asset/ktp/' . $ktp_pihak_satu_name, $enkripsi_ktp);
        // end proses encrpty ktp

        // start proses encrpyt npwp
        $npwp_binary = file_get_contents('asset/npwp/' . $npwp_name);
        $data_npwp = $npwp_binary;
        $enkripsi_npwp = $enk->encrypt($data_npwp);
        
        unlink('asset/npwp/' . $npwp_name);
        file_put_contents('asset/npwp/' . $npwp_name, $enkripsi_npwp);
        // end proses encrpty npwp

         // start proses encrpyt legal
         $legal_binary = file_get_contents('asset/legal/' . $legalitas_name);
         $data_legal = $legal_binary;
         $enkripsi_legal = $enk->encrypt($data_legal);
                
         unlink('asset/legal/' . $legalitas_name);
         file_put_contents('asset/legal/' . $legalitas_name, $enkripsi_legal);
         // end proses encrpty legal
        ################ end encrypt ################

        $perseroTerbatas = new PerseroanTerbatas;
        $perseroTerbatas->nama_pt = $validateData['nama_pt'];
        $perseroTerbatas->alamat = $validateData['alamat'];
        $perseroTerbatas->ktp = $ktp_pihak_satu_name;
        $perseroTerbatas->npwp_pribadi = $npwp_name;
        $perseroTerbatas->legalitas_badan_hukum = $legalitas_name;
        $perseroTerbatas->user()->associate(Auth::user());

        // set public & private key
        $perseroTerbatas->publickey = $publicKey;
        $perseroTerbatas->privatekey = $privateKey;
        $perseroTerbatas->encrypt = '0';

        $perseroTerbatas->save();
        return redirect(route('perseroanterbatas.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerseroanTerbatas  $perseroanTerbatas
     * @return \Illuminate\Http\Response
     */
    public function show(PerseroanTerbatas $perseroanTerbatas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerseroanTerbatas  $perseroanTerbatas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PerseroanTerbatas::find($id);

        return view('pemohon.sidebar.perseroan_terbatas.edit')->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerseroanTerbatas  $perseroanTerbatas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama_pt' => 'required',
            'alamat' => 'required'
        ]);

        $user = User::find(Auth::user()->id);
        $data = PerseroanTerbatas::find($id);
        $originalPath = $this->path . '/' . $user->id . '/perseroanterbatas' . '/';
        $data->nama_pt = $validateData['nama_pt'];
        $data->alamat = $validateData['alamat'];
        if ($request->file('ktp') || $request->file('npwp') || $request->file('legalitas')) {

            if ($request->file('ktp') != null) {
                $ktp_pihak_satu = $request->file('ktp');
                $ktp_pihak_satu_image = Image::make($ktp_pihak_satu);
                $ktp_pihak_satu_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $ktp_pihak_satu->getClientOriginalName();
                $ktp_pihak_satu_image->save($originalPath . $ktp_pihak_satu_name);
                $data->ktp = $ktp_pihak_satu_name;
            }
            if ($request->file('npwp') != null) {
                $npwp = $request->file('npwp');
                $npwp_image = Image::make($npwp);
                $npwp_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $npwp->getClientOriginalName();
                $npwp_image->save($originalPath . $npwp_name);
                $data->npwp_pribadi = $npwp_name;
            }
            if ($request->file('legalitas') != null) {
                $legalitas = $request->file('legalitas');
                $legalitas_image = Image::make($legalitas);
                $legalitas_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $legalitas->getClientOriginalName();
                $legalitas_image->save($originalPath . $legalitas_name);
                $data->legalitas_badan_hukum = $legalitas_name;
            }
        }
        $data->save();
        return redirect(route('perseroanterbatas.index'));
    }

    public function ubahStatus($id) {
        $data = PerseroanTerbatas::where('id', $id)->get()->first();
        if ($data->status != 1) {
            $data->status = 1;
        } else {
            $data->status = 0;
        }
        $data->save();
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerseroanTerbatas  $perseroanTerbatas
     * @return \Illuminate\Http\Response
     */
    public function destroy($perseroanTerbatas)
    {
        $data = PerseroanTerbatas::find($perseroanTerbatas);
        $data->delete();
        return redirect()->back();
    }
}
