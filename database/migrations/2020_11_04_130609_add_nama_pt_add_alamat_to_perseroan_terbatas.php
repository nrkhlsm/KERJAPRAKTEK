<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaPtAddAlamatToPerseroanTerbatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perseroan_terbatas', function (Blueprint $table) {
            $table->string('nama_pt')->after('id');
            $table->string('alamat')->after('nama_pt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perseroan_terbatas', function (Blueprint $table) {
            $table->dropIfExists('perseroan_terbatas');
        });
    }
}
