<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublicKeyToAktaJualBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akte_jual_belis', function (Blueprint $table) {
            $table->text('publickey');
            $table->text('privatekey');
            $table->string('encrypt');
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
            //
        });
    }
}
