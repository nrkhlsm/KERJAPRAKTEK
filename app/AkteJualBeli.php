<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkteJualBeli extends Model
{
    protected $fillable = [
        'ktp_pihak_satu',
        'kk_pihak_satu',
        'akta_perkawinan',
        'npwp',
        'skbri',
        'ganti_nama',
        'ktp_pihak_dua',
        'kk_pihak_dua',
        'sertifikat_tanah',
        'spt_pbb',
        'jenis_barang',
        'keterangan'
    ];

    public function user() {

        return $this->belongsTo(User::class, 'user_id');

    }
}
