<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AkteJualBeli;

use \phpseclib\Crypt\RSA;
use \phpseclib\Crypt\RSA as Crypt_RSA;

class JualBeliRSA extends Controller
{
    public function decrypt($id)
    {
       $data = AkteJualBeli::find($id);

       ################ start decrypt ################
       $dek = new Crypt_RSA();
       $dek->loadKey($data->privatekey);
       $dek->setEncryptionMode(2);

       // start proses encrpyt ktp 1
       $data_kt_1 = file_get_contents('asset/ktp/' . $data->ktp_pihak_satu);
       $enkripsi_ktp_1 = $dek->decrypt($data_kt_1);
       
       unlink('asset/ktp/' . $data->ktp_pihak_satu);
       file_put_contents('asset/ktp/' . $data->ktp_pihak_satu, $enkripsi_ktp_1);
       // end proses encrpty ktp 1

       // start proses encrpyt kk 1
       $data_kk_1 = file_get_contents('asset/kk/' . $data->kk_pihak_satu);
       $enkripsi_kk_1 = $dek->decrypt($data_kk_1);
       
       unlink('asset/kk/' . $data->kk_pihak_satu);
       file_put_contents('asset/kk/' . $data->kk_pihak_satu, $enkripsi_kk_1);
       // end proses encrpty kk 1

       // start proses encrpyt akta_perkawinan
       $data_kawin = file_get_contents('asset/akta_kawin/' . $data->akta_perkawinan);
       $enkripsi_kawin = $dek->decrypt($data_kawin);
       
       unlink('asset/akta_kawin/' . $data->akta_perkawinan);
       file_put_contents('asset/akta_kawin/' . $data->akta_perkawinan, $enkripsi_kawin);
       // end proses encrpty akta_perkawinan

       // start proses encrpyt npwp
       $data_npwp = file_get_contents('asset/npwp/' . $data->npwp);
       $enkripsi_npwp = $dek->decrypt($data_npwp);
       
       unlink('asset/npwp/' . $data->npwp);
       file_put_contents('asset/npwp/' . $data->npwp, $enkripsi_npwp);
       // end proses encrpty npwp

       // start proses encrpyt skbri
       $data_skbri = file_get_contents('asset/skbri/' . $data->skbri);
       $enkripsi_skbri = $dek->decrypt($data_skbri);
       
       unlink('asset/skbri/' . $data->skbri);
       file_put_contents('asset/skbri/' . $data->skbri, $enkripsi_skbri);
       // end proses encrpty skbri

        // start proses encrpyt ganti_nama
       $data_ganti_nama = file_get_contents('asset/ganti_nama/' . $data->ganti_nama);
       $enkripsi_ganti_nama = $dek->decrypt($data_ganti_nama);
       
       unlink('asset/ganti_nama/' . $data->ganti_nama);
       file_put_contents('asset/ganti_nama/' . $data->ganti_nama, $enkripsi_ganti_nama);
       // end proses encrpty ganti_nama

       // start proses encrpyt ktp 2
       $data_kt_2 = file_get_contents('asset/ktp/' . $data->ktp_pihak_dua);
       $enkripsi_ktp_2 = $dek->decrypt($data_kt_2);
       
       unlink('asset/ktp/' . $data->ktp_pihak_dua);
       file_put_contents('asset/ktp/' . $data->ktp_pihak_dua, $enkripsi_ktp_2);
       // end proses encrpty ktp 2

       // start proses encrpyt kk 2
       $data_kk_2 = file_get_contents('asset/kk/' . $data->kk_pihak_dua);
       $enkripsi_kk_2 = $dek->decrypt($data_kk_2);
       
       unlink('asset/kk/' . $data->kk_pihak_dua);
       file_put_contents('asset/kk/' . $data->kk_pihak_dua, $enkripsi_kk_2);
       // end proses encrpty kk 2

       // start proses encrpyt sertifikat_tanah
       $data_sertifikat_tanah = file_get_contents('asset/sertifikat_tanah/' . $data->sertifikat_tanah);
       $enkripsi_sertifikat_tanah = $dek->decrypt($data_sertifikat_tanah);
       
       unlink('asset/sertifikat_tanah/' . $data->sertifikat_tanah);
       file_put_contents('asset/sertifikat_tanah/' . $data->sertifikat_tanah, $enkripsi_sertifikat_tanah);
       // end proses encrpty sertifikat_tanah

       // start proses encrpyt spt_pbb
       $data_spt_pbb = file_get_contents('asset/spt_pbb/' . $data->spt_pbb);
       $enkripsi_spt_pbb = $dek->decrypt($data_spt_pbb);
       
       unlink('asset/spt_pbb/' . $data->spt_pbb);
       file_put_contents('asset/spt_pbb/' . $data->spt_pbb, $enkripsi_spt_pbb);
       // end proses encrpty spt_pbb

       ################ end encrypt ################

        $data->encrypt = '1';
        $data->save();
     
        return back();
    }


    public function encrypt($id)
    {
       $data = AkteJualBeli::find($id);

       ################ start decrypt ################
       // set key
       $rsa = $rsa = new RSA();
       $keys = $rsa->createKey(4096);
       $publicKey = $keys['publickey'];
       $privateKey = $keys['privatekey'];

       // encrypt proses
       $enk = new Crypt_RSA();
       $enk->loadKey($publicKey);
       $enk->setEncryptionMode(2);

       $dek = new Crypt_RSA();
       $dek->loadKey($data->privatekey);
       $dek->setEncryptionMode(2);

       // start proses encrpyt ktp 1
       $data_kt_1 = file_get_contents('asset/ktp/' . $data->ktp_pihak_satu);
       $enkripsi_ktp_1 = $enk->encrypt($data_kt_1);
       
       unlink('asset/ktp/' . $data->ktp_pihak_satu);
       file_put_contents('asset/ktp/' . $data->ktp_pihak_satu, $enkripsi_ktp_1);
       // end proses encrpty ktp 1

       // start proses encrpyt kk 1
       $data_kk_1 = file_get_contents('asset/kk/' . $data->kk_pihak_satu);
       $enkripsi_kk_1 = $enk->encrypt($data_kk_1);
       
       unlink('asset/kk/' . $data->kk_pihak_satu);
       file_put_contents('asset/kk/' . $data->kk_pihak_satu, $enkripsi_kk_1);
       // end proses encrpty kk 1

       // start proses encrpyt akta_perkawinan
       $data_kawin = file_get_contents('asset/akta_kawin/' . $data->akta_perkawinan);
       $enkripsi_kawin = $enk->encrypt($data_kawin);
       
       unlink('asset/akta_kawin/' . $data->akta_perkawinan);
       file_put_contents('asset/akta_kawin/' . $data->akta_perkawinan, $enkripsi_kawin);
       // end proses encrpty akta_perkawinan

       // start proses encrpyt npwp
       $data_npwp = file_get_contents('asset/npwp/' . $data->npwp);
       $enkripsi_npwp = $enk->encrypt($data_npwp);
       
       unlink('asset/npwp/' . $data->npwp);
       file_put_contents('asset/npwp/' . $data->npwp, $enkripsi_npwp);
       // end proses encrpty npwp

       // start proses encrpyt skbri
       $data_skbri = file_get_contents('asset/skbri/' . $data->skbri);
       $enkripsi_skbri = $enk->encrypt($data_skbri);
       
       unlink('asset/skbri/' . $data->skbri);
       file_put_contents('asset/skbri/' . $data->skbri, $enkripsi_skbri);
       // end proses encrpty skbri

        // start proses encrpyt ganti_nama
       $data_ganti_nama = file_get_contents('asset/ganti_nama/' . $data->ganti_nama);
       $enkripsi_ganti_nama = $enk->encrypt($data_ganti_nama);
       
       unlink('asset/ganti_nama/' . $data->ganti_nama);
       file_put_contents('asset/ganti_nama/' . $data->ganti_nama, $enkripsi_ganti_nama);
       // end proses encrpty ganti_nama

       // start proses encrpyt ktp 2
       $data_kt_2 = file_get_contents('asset/ktp/' . $data->ktp_pihak_dua);
       $enkripsi_ktp_2 = $enk->encrypt($data_kt_2);
       
       unlink('asset/ktp/' . $data->ktp_pihak_dua);
       file_put_contents('asset/ktp/' . $data->ktp_pihak_dua, $enkripsi_ktp_2);
       // end proses encrpty ktp 2

       // start proses encrpyt kk 2
       $data_kk_2 = file_get_contents('asset/kk/' . $data->kk_pihak_dua);
       $enkripsi_kk_2 = $enk->encrypt($data_kk_2);
       
       unlink('asset/kk/' . $data->kk_pihak_dua);
       file_put_contents('asset/kk/' . $data->kk_pihak_dua, $enkripsi_kk_2);
       // end proses encrpty kk 2

       // start proses encrpyt sertifikat_tanah
       $data_sertifikat_tanah = file_get_contents('asset/sertifikat_tanah/' . $data->sertifikat_tanah);
       $enkripsi_sertifikat_tanah = $enk->encrypt($data_sertifikat_tanah);
       
       unlink('asset/sertifikat_tanah/' . $data->sertifikat_tanah);
       file_put_contents('asset/sertifikat_tanah/' . $data->sertifikat_tanah, $enkripsi_sertifikat_tanah);
       // end proses encrpty sertifikat_tanah

       // start proses encrpyt spt_pbb
       $data_spt_pbb = file_get_contents('asset/spt_pbb/' . $data->spt_pbb);
       $enkripsi_spt_pbb = $enk->encrypt($data_spt_pbb);
       
       unlink('asset/spt_pbb/' . $data->spt_pbb);
       file_put_contents('asset/spt_pbb/' . $data->spt_pbb, $enkripsi_spt_pbb);
       // end proses encrpty spt_pbb

       ################ end encrypt ################

       $data->publickey = $publicKey;
       $data->privatekey = $privateKey;
       $data->encrypt = '0';
       $data->save();
     
        return back();
    }
}
