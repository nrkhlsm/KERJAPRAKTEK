<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkteJualBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akte_jual_belis', function (Blueprint $table) {
            $table->id();
            $table->string('ktp_pihak_satu');
            $table->string('kk_pihak_satu');
            $table->string('akta_perkawinan');
            $table->string('npwp');
            $table->string('skbri')->nullable();
            $table->string('ganti_nama')->nullable();
            $table->string('ktp_pihak_dua');
            $table->string('kk_pihak_dua');
            $table->string('sertifikat_tanah');
            $table->string('spt_pbb');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akte_jual_belis');
    }
}
