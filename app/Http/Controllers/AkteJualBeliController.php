<?php

namespace App\Http\Controllers;

use App\AkteJualBeli;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Image;

use \phpseclib\Crypt\RSA;
use \phpseclib\Crypt\RSA as Crypt_RSA;

class AkteJualBeliController extends Controller
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
        $user = User::find(Auth::user()->id);
        $data = AkteJualBeli::all();
        return view('pemohon.sidebar.jualbeli.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemohon.sidebar.jualbeli.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        // $validateData = $request->validate([
        //     'ktp_pihak_satu' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        //     'kk_pihak_satu' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        //     'npwp' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        //     'skbri' => 'image|mimes:jpeg,png,jpg,gif,svg',
        //     'ganti_nama' => 'image|mimes:jpeg,png,jpg,gif,svg',
        //     'ktp_pihak_dua' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        //     'kk_pihak_dua' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        //     'sertifikat_tanah' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        //     'stp_pbb' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
        //     ]);

        $user = User::find(Auth::user()->id);
        // if (!File::isDirectory($this->path)) {
        //     File::makeDirectory($this->path);
        // }
        // if (!File::isDirectory($this->path . '/' . $user->id)) {
        //     File::makeDirectory($this->path . '/' . $user->id);
        // }

        $originalPath = $this->path . '/' . $user->id . '/';

        $ktp_pihak_satu = $request->file('ktp_pihak_satu');
        $ktp_pihak_satu_image = Image::make($ktp_pihak_satu);
        $ktp_pihak_satu_name = Carbon::now()->timestamp . '1-' . uniqid() . '-' . $ktp_pihak_satu->getClientOriginalName();
        $ktp_pihak_satu_image->save('asset/ktp/' . $ktp_pihak_satu_name);

        $kk_pihak_satu = $request->file('kk_pihak_satu');
        $kk_pihak_satu_image = Image::make($kk_pihak_satu);
        $kk_pihak_satu_name = Carbon::now()->timestamp . '1-' . uniqid() . '-' . $kk_pihak_satu->getClientOriginalName();
        $kk_pihak_satu_image->save('asset/kk/' . $kk_pihak_satu_name);

        $akta_perkawinan = $request->file('akta_perkawinan');
        $akta_perkawinan_image = Image::make($akta_perkawinan);
        $akta_perkawinan_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $akta_perkawinan->getClientOriginalName();
        $akta_perkawinan_image->save('asset/akta_kawin/' . $akta_perkawinan_name);

        $npwp = $request->file('npwp');
        $npwp_image = Image::make($npwp);
        $npwp_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $npwp->getClientOriginalName();
        $npwp_image->save('asset/npwp/' . $npwp_name);

        $skbri = $request->file('skbri');
        $skbri_image = Image::make($skbri);
        $skbri_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $skbri->getClientOriginalName();
        $skbri_image->save('asset/skbri/' . $skbri_name);

        $ganti_nama = $request->file('ganti_nama');
        $ganti_nama_image = Image::make($ganti_nama);
        $ganti_nama_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $ganti_nama->getClientOriginalName();
        $ganti_nama_image->save('asset/ganti_nama/' . $ganti_nama_name);

        $ktp_pihak_dua = $request->file('ktp_pihak_dua');
        $ktp_pihak_dua_image = Image::make($ktp_pihak_dua);
        $ktp_pihak_dua_name = Carbon::now()->timestamp . '2-' . uniqid() . '-' . $ktp_pihak_dua->getClientOriginalName();
        $ktp_pihak_dua_image->save('asset/ktp/' . $ktp_pihak_dua_name);

        $kk_pihak_dua = $request->file('kk_pihak_dua');
        $kk_pihak_dua_image = Image::make($kk_pihak_dua);
        $kk_pihak_dua_name = Carbon::now()->timestamp . '2-' . uniqid() . '-' . $kk_pihak_dua->getClientOriginalName();
        $kk_pihak_dua_image->save('asset/kk/' . $kk_pihak_dua_name);

        $sertifikat_tanah = $request->file('sertifikat_tanah');
        $sertifikat_tanah_image = Image::make($sertifikat_tanah);
        $sertifikat_tanah_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $sertifikat_tanah->getClientOriginalName();
        $sertifikat_tanah_image->save('asset/sertifikat_tanah/' . $sertifikat_tanah_name);

        $spt_pbb = $request->file('spt_pbb');
        $spt_pbb_image = Image::make($spt_pbb);
        $spt_pbb_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $spt_pbb->getClientOriginalName();
        $spt_pbb_image->save('asset/spt_pbb/' . $spt_pbb_name);


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
        
        // start proses encrpyt ktp 1
        $data_kt_1 = file_get_contents('asset/ktp/' . $ktp_pihak_satu_name);
        $enkripsi_ktp_1 = $enk->encrypt($data_kt_1);
        
        unlink('asset/ktp/' . $ktp_pihak_satu_name);
        file_put_contents('asset/ktp/' . $ktp_pihak_satu_name, $enkripsi_ktp_1);
        // end proses encrpty ktp 1

        // start proses encrpyt kk 1
        $data_kk_1 = file_get_contents('asset/kk/' . $kk_pihak_satu_name);
        $enkripsi_kk_1 = $enk->encrypt($data_kk_1);
        
        unlink('asset/kk/' . $kk_pihak_satu_name);
        file_put_contents('asset/kk/' . $kk_pihak_satu_name, $enkripsi_kk_1);
        // end proses encrpty kk 1

        // start proses encrpyt akta_perkawinan
        $data_kawin = file_get_contents('asset/akta_kawin/' . $akta_perkawinan_name);
        $enkripsi_kawin = $enk->encrypt($data_kawin);
        
        unlink('asset/akta_kawin/' . $akta_perkawinan_name);
        file_put_contents('asset/akta_kawin/' . $akta_perkawinan_name, $enkripsi_kawin);
        // end proses encrpty akta_perkawinan

        // start proses encrpyt npwp
        $data_npwp = file_get_contents('asset/npwp/' . $npwp_name);
        $enkripsi_npwp = $enk->encrypt($data_npwp);
        
        unlink('asset/npwp/' . $npwp_name);
        file_put_contents('asset/npwp/' . $npwp_name, $enkripsi_npwp);
        // end proses encrpty npwp

        // start proses encrpyt skbri
        $data_skbri = file_get_contents('asset/skbri/' . $skbri_name);
        $enkripsi_skbri = $enk->encrypt($data_skbri);
        
        unlink('asset/skbri/' . $skbri_name);
        file_put_contents('asset/skbri/' . $skbri_name, $enkripsi_skbri);
        // end proses encrpty skbri

         // start proses encrpyt ganti_nama
        $data_ganti_nama = file_get_contents('asset/ganti_nama/' . $ganti_nama_name);
        $enkripsi_ganti_nama = $enk->encrypt($data_ganti_nama);
        
        unlink('asset/ganti_nama/' . $ganti_nama_name);
        file_put_contents('asset/ganti_nama/' . $ganti_nama_name, $enkripsi_ganti_nama);
        // end proses encrpty ganti_nama

        // start proses encrpyt ktp 2
        $data_kt_2 = file_get_contents('asset/ktp/' . $ktp_pihak_dua_name);
        $enkripsi_ktp_2 = $enk->encrypt($data_kt_2);
        
        unlink('asset/ktp/' . $ktp_pihak_dua_name);
        file_put_contents('asset/ktp/' . $ktp_pihak_dua_name, $enkripsi_ktp_2);
        // end proses encrpty ktp 2

        // start proses encrpyt kk 2
        $data_kk_2 = file_get_contents('asset/kk/' . $kk_pihak_dua_name);
        $enkripsi_kk_2 = $enk->encrypt($data_kk_2);
        
        unlink('asset/kk/' . $kk_pihak_dua_name);
        file_put_contents('asset/kk/' . $kk_pihak_dua_name, $enkripsi_kk_2);
        // end proses encrpty kk 2

        // start proses encrpyt sertifikat_tanah
        $data_sertifikat_tanah = file_get_contents('asset/sertifikat_tanah/' . $sertifikat_tanah_name);
        $enkripsi_sertifikat_tanah = $enk->encrypt($data_sertifikat_tanah);
        
        unlink('asset/sertifikat_tanah/' . $sertifikat_tanah_name);
        file_put_contents('asset/sertifikat_tanah/' . $sertifikat_tanah_name, $enkripsi_sertifikat_tanah);
        // end proses encrpty sertifikat_tanah

        // start proses encrpyt spt_pbb
        $data_spt_pbb = file_get_contents('asset/spt_pbb/' . $spt_pbb_name);
        $enkripsi_spt_pbb = $enk->encrypt($data_spt_pbb);
        
        unlink('asset/spt_pbb/' . $spt_pbb_name);
        file_put_contents('asset/spt_pbb/' . $spt_pbb_name, $enkripsi_spt_pbb);
        // end proses encrpty spt_pbb

        ################ end encrypt ################


        $akte_jual_beli = new AkteJualBeli;
        $akte_jual_beli->ktp_pihak_satu = $ktp_pihak_satu_name;
        $akte_jual_beli->kk_pihak_satu = $kk_pihak_satu_name;
        $akte_jual_beli->akta_perkawinan = $akta_perkawinan_name;
        $akte_jual_beli->npwp = $npwp_name;
        $akte_jual_beli->skbri = $skbri_name;
        $akte_jual_beli->ganti_nama = $ganti_nama_name;
        $akte_jual_beli->ktp_pihak_dua = $ktp_pihak_dua_name;
        $akte_jual_beli->kk_pihak_dua = $kk_pihak_dua_name;
        $akte_jual_beli->sertifikat_tanah = $sertifikat_tanah_name;
        $akte_jual_beli->spt_pbb = $spt_pbb_name;
        $akte_jual_beli->jenis_barang = $request->jenis_barang;
        $akte_jual_beli->keterangan = $request->keterangan;
        $akte_jual_beli->user()->associate(Auth::user());

        // set public & private key
        $akte_jual_beli->publickey = $publicKey;
        $akte_jual_beli->privatekey = $privateKey;
        $akte_jual_beli->encrypt = '0';

        $akte_jual_beli->save();
        return redirect(route('jualbeli.index'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\AkteJualBeli  $akteJualBeli
     * @return \Illuminate\Http\Response
     */
    public function show(AkteJualBeli $akteJualBeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AkteJualBeli  $akteJualBeli
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AkteJualBeli::find($id);
        return view('pemohon.sidebar.jualbeli.edit')->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AkteJualBeli  $akteJualBeli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find(Auth::user()->id);
        $data = AkteJualBeli::find($id);
        $originalPath = $this->path . '/' . $user->id . '/';
        if (
            $request->file('ktp_pihak_satu')
            || $request->file('kk_pihak_satu')
            || $request->file('akta_perkawinan')
            || $request->file('npwp')
            || $request->file('skbri')
            || $request->file('ganti_nama')
            || $request->file('ktp_pihak_dua')
            || $request->file('kk_pihak_dua')
            || $request->file('sertifikat_tanah')
            || $request->file('spt_pbb')
        ) {


            if ($request->file('ktp_pihak_satu') != null) {
                $ktp_pihak_satu = $request->file('ktp_pihak_satu');
                $ktp_pihak_satu_image = Image::make($ktp_pihak_satu);
                $ktp_pihak_satu_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $ktp_pihak_satu->getClientOriginalName();
                $ktp_pihak_satu_image->save($originalPath . $ktp_pihak_satu_name);
                $data->ktp_pihak_satu=$ktp_pihak_satu_name;
            }
            if ($request->file('kk_pihak_satu') != null) {
                $kk_pihak_satu = $request->file('kk_pihak_satu');
                $kk_pihak_satu_image = Image::make($kk_pihak_satu);
                $kk_pihak_satu_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $kk_pihak_satu->getClientOriginalName();
                $kk_pihak_satu_image->save($originalPath . $kk_pihak_satu_name);
                $data->kk_pihak_satu=$kk_pihak_satu_name;
            }
            if ($request->file('akta_perkawinan') != null) {
                $akta_perkawinan = $request->file('akta_perkawinan');
                $akta_perkawinan_image = Image::make($akta_perkawinan);
                $akta_perkawinan_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $akta_perkawinan->getClientOriginalName();
                $akta_perkawinan_image->save($originalPath . $akta_perkawinan_name);
                $data->akta_perkawinan=$akta_perkawinan_name;
            }
            if ($request->file('npwp') != null) {
                $npwp = $request->file('npwp');
                $npwp_image = Image::make($npwp);
                $npwp_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $npwp->getClientOriginalName();
                $npwp_image->save($originalPath . $npwp_name);
                $data->npwp=$npwp_name;
            }
            if ($request->file('skbri') != null) {
                $skbri = $request->file('skbri');
                $skbri_image = Image::make($skbri);
                $skbri_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $skbri->getClientOriginalName();
                $skbri_image->save($originalPath . $skbri_name);
                $data->skbri=$skbri_name;
            }
            if ($request->file('ganti_nama') != null) {
                $ganti_nama = $request->file('ganti_nama');
                $ganti_nama_image = Image::make($ganti_nama);
                $ganti_nama_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $ganti_nama->getClientOriginalName();
                $ganti_nama_image->save($originalPath . $ganti_nama_name);
                $data->ganti_nama=$ganti_nama_name;

            }
            if ($request->file('ktp_pihak_dua') != null) {
                $ktp_pihak_dua = $request->file('ktp_pihak_dua');
                $ktp_pihak_dua_image = Image::make($ktp_pihak_dua);
                $ktp_pihak_dua_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $ktp_pihak_dua->getClientOriginalName();
                $ktp_pihak_dua_image->save($originalPath . $ktp_pihak_dua_name);
                $data->ktp_pihak_dua=$ktp_pihak_dua_name;
            }
            if ($request->file('kk_pihak_dua') != null) {
                $kk_pihak_dua = $request->file('kk_pihak_dua');
                $kk_pihak_dua_image = Image::make($kk_pihak_dua);
                $kk_pihak_dua_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $kk_pihak_dua->getClientOriginalName();
                $kk_pihak_dua_image->save($originalPath . $kk_pihak_dua_name);
                $data->kk_pihak_dua=$ktp_pihak_dua_name;
            }
            if ($request->file('sertifikat_tanah') != null) {
                $sertifikat_tanah = $request->file('sertifikat_tanah');
                $sertifikat_tanah_image = Image::make($sertifikat_tanah);
                $sertifikat_tanah_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $sertifikat_tanah->getClientOriginalName();
                $sertifikat_tanah_image->save($originalPath . $sertifikat_tanah_name);
                $data->sertifikat_tanah=$sertifikat_tanah_name;
            }
            if ($request->file('spt_pbb') != null) {
                $spt_pbb = $request->file('spt_pbb');
                $spt_pbb_image = Image::make($spt_pbb);
                $spt_pbb_name = Carbon::now()->timestamp . '-' . uniqid() . '-' . $spt_pbb->getClientOriginalName();
                $spt_pbb_image->save($originalPath . $spt_pbb_name);
                $data->spt_pbb=$spt_pbb_name;
            }

            $data->save();

            return redirect(route('jualbeli.index'));
        }
    }

    public function ubahStatus($id) {
        $data = AkteJualBeli::where('id', $id)->get()->first();
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
     * @param  \App\AkteJualBeli  $akteJualBeli
     * @return \Illuminate\Http\Response
     */
    public function destroy($akteJualBeli)
    {
        $data = AkteJualBeli::find($akteJualBeli);
        $data->delete();
        return redirect()->back();
    }
}
