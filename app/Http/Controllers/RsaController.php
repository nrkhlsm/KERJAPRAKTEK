<?php

namespace App\Http\Controllers;

use App\AkteJualBeli;
use App\PerseroanCommanditer;
use App\PerseroanTerbatas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use \phpseclib\Crypt\RSA;
use \phpseclib\Crypt\RSA as Crypt_RSA;

class RsaController extends Controller
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
        $image_binary = file_get_contents('img.jpg');

        $rsa = $rsa = new RSA();
        $keys = $rsa->createKey(4096);
        $publicKey = $keys['publickey'];
        $privateKey = $keys['privatekey'];

        $enk = new Crypt_RSA();
        $enk->loadKey($publicKey);
        $enk->setEncryptionMode(2);

        $data = $image_binary;
        $output = $enk->encrypt($data);
        $enkripsi =  $output;
 
        $dek = new Crypt_RSA();
        $dek->loadKey($privateKey);
        $dek->setEncryptionMode(2);

        $dekripsi = $dek->decrypt($enkripsi);

        file_put_contents("enkrips.jpg", $enkripsi);
        file_put_contents("dekrips.jpg", $dekripsi);
    }
}
