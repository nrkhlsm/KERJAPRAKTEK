<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PerseroanCommanditer;
use App\PerseroanTerbatas;

use \phpseclib\Crypt\RSA;
use \phpseclib\Crypt\RSA as Crypt_RSA;

class PerseroRSA extends Controller
{
    public function decrypt($id, $status)
    {
        if($status == 1){
            $data = PerseroanCommanditer::find($id);
        } else {
            $data = PerseroanTerbatas::find($id);
        }

       ################ start encrypt ################
       $dek = new Crypt_RSA();
       $dek->loadKey($data->privatekey);
       $dek->setEncryptionMode(2);

       // start proses encrpyt ktp
       $data_ktp = file_get_contents('asset/ktp/' . $data->ktp);
       $dekripsi_ktp = $dek->decrypt($data_ktp);
       
       unlink('asset/ktp/' . $data->ktp);
       file_put_contents('asset/ktp/' . $data->ktp, $dekripsi_ktp);
       // end proses encrpty ktp

       // start proses encrpyt npwp
       $data_npwp = file_get_contents('asset/npwp/' . $data->npwp_pribadi);
       $dekripsi_npwp = $dek->decrypt($data_npwp);
              
       unlink('asset/npwp/' . $data->npwp_pribadi);
       file_put_contents('asset/npwp/' . $data->npwp_pribadi, $dekripsi_npwp);
       // end proses encrpty npwp

       if($status == 2){
        // start proses encrpyt legal
          $data_legal = file_get_contents('asset/legal/' . $data->legalitas_badan_hukum);
          $dekripsi_legal = $dek->decrypt($data_legal);
                    
          unlink('asset/legal/' . $data->legalitas_badan_hukum);
          file_put_contents('asset/legal/' . $data->legalitas_badan_hukum, $dekripsi_legal);
        // end proses encrpty legal
       }

       ################ end encrypt ################

        $data->encrypt = '1';
        $data->save();
     
        return back();
    }

    public function encrypt($id, $status)
    {
        if($status == 1){
            $data = PerseroanCommanditer::find($id);
        } else {
            $data = PerseroanTerbatas::find($id);
        }

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
        $data_ktp = file_get_contents('asset/ktp/' . $data->ktp);
        $enkripsi_ktp = $enk->encrypt($data_ktp);
        
        unlink('asset/ktp/' . $data->ktp);
        file_put_contents('asset/ktp/' . $data->ktp, $enkripsi_ktp);
        // end proses encrpty ktp

        // start proses encrpyt npwp
        $data_npwp = file_get_contents('asset/npwp/' . $data->npwp_pribadi);
        $enkripsi_npwp = $enk->encrypt($data_npwp);
        
        unlink('asset/npwp/' . $data->npwp_pribadi);
        file_put_contents('asset/npwp/' .$data->npwp_pribadi, $enkripsi_npwp);
        // end proses encrpty npwp

        if($status == 2){
            // start proses encrpyt legal
            $data_legal = file_get_contents('asset/legal/' . $data->legalitas_badan_hukum);
            $enkripsi_legal = $enk->encrypt($data_legal);
            
            unlink('asset/legal/' . $data->legalitas_badan_hukum);
            file_put_contents('asset/legal/' .$data->legalitas_badan_hukum, $enkripsi_legal);
            // end proses encrpty legal
        }
        ################ end encrypt ################

        $data->publickey = $publicKey;
        $data->privatekey = $privateKey;
        $data->encrypt = '0';
        $data->save();
     
        return back();
    }
}