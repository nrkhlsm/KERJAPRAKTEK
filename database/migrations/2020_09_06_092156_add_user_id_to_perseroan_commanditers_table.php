<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToPerseroanCommanditersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('perseroan_commanditers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('npwp_pribadi');

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
        Schema::table('perseroan_commanditers', function (Blueprint $table) {
            $table->dropIfExists('user_id');
        });
    }
}
