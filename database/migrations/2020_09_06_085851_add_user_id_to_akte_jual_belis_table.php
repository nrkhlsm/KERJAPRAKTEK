<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToAkteJualBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akte_jual_belis', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('spt_pbb');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->dropColumn('akte_jual_belis');
        });
    }
}
