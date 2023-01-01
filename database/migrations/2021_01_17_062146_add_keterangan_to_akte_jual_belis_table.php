<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeteranganToAkteJualBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akte_jual_belis', function (Blueprint $table) {
            $table->string('jenis_barang');
            $table->longText('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('akte_jual_belis', function (Blueprint $table) {
            Schema::dropIfExists('akte_jual_belis');
        });
    }
}
