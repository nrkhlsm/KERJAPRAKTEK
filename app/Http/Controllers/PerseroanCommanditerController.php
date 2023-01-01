<?php

namespace App\Http\Controllers;

use App\PerseroanCommanditer;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
use Image;

use \phpseclib\Crypt\RSA;
use \phpseclib\Crypt\RSA as Crypt_RSA;

class PerseroanCommanditerController extends Controller
{
    public $path;
    public function __construct()
    {
        $this->path = storage_path('app/public/documents');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PerseroanCommanditer::all();
        return view('pemohon.sidebar.perseroan_commanditer.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemohon.sidebar.perseroan_commanditer.add');
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
        // if (!File::isDirectory($this->path . '/' . $user->id . '/perseroankomanditer')) {
        //     File::makeDirectory($this->path . '/' . $user->id . '/perseroankomanditer');
        // }
        // $originalPath = $this->path . '/' . $user->id . '/perseroankomanditer' . '/';

        $ktp_pihak_satu = $request->file('ktp');
        $ktp_pihak_satu_image = Image::make($ktp_pihak_satu);
        $ktp_pihak_satu_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $ktp_pihak_satu->getClientOriginalName();
        $ktp_pihak_satu_image->save('asset/ktp/' . $ktp_pihak_satu_name);

        $npwp = $request->file('npwp');
        $npwp_image = Image::make($npwp);
        $npwp_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $npwp->getClientOriginalName();
        $npwp_image->save('asset/npwp/' . $npwp_name);

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
        ################ end encrypt ################

        // set data to save database
        $perseroCommand = new PerseroanCommanditer;
        $perseroCommand->nama_pt = $validateData['nama_pt'];
        $perseroCommand->alamat = $validateData['alamat'];
        $perseroCommand->ktp = $ktp_pihak_satu_name;
        $perseroCommand->npwp_pribadi = $npwp_name;

        // set public & private key
        $perseroCommand->publickey = $publicKey;
        $perseroCommand->privatekey = $privateKey;
        $perseroCommand->encrypt = '0';
        
        $perseroCommand->user()->associate(Auth::user());
        $perseroCommand->save();
        return redirect(route('perseroancommanditer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerseroanCommanditer  $perseroanCommanditer
     * @return \Illuminate\Http\Response
     */
    public function show(PerseroanCommanditer $perseroanCommanditer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerseroanCommanditer  $perseroanCommanditer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PerseroanCommanditer::find($id);

        return view('pemohon.sidebar.perseroan_commanditer.edit')->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerseroanCommanditer  $perseroanCommanditer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'nama_pt' => 'required',
            'alamat' => 'required'
        ]);

        $user = User::find(Auth::user()->id);
        $data = PerseroanCommanditer::find($id);
        $originalPath = $this->path . '/' . $user->id . '/perseroankomanditer' . '/';
        $data->nama_pt = $validateData['nama_pt'];
        $data->alamat = $validateData['alamat'];
        if ($request->file('ktp') || $request->file('npwp')) {

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
        }

        $data->save();

        return redirect(route('perseroancommanditer.index'));
    }

    public function ubahStatus($id) {
        $data = PerseroanCommanditer::where('id', $id)->get()->first();
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
     * @param  \App\PerseroanCommanditer  $perseroanCommanditer
     * @return \Illuminate\Http\Response
     */
    public function destroy($perseroanCommanditer)
    {
        $data = PerseroanCommanditer::find($perseroanCommanditer);
        $data->delete();
        return redirect()->back();
    }
}
