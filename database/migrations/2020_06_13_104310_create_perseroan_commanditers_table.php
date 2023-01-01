<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerseroanCommanditersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perseroan_commanditers', function (Blueprint $table) {
            $table->id();
            $table->string('ktp');
            $table->string('npwp_pribadi');

            $table->text('publickey');
            $table->text('privatekey');
            $table->string('encrypt');
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
        Schema::dropIfExists('perseroan_commanditers');
    }
}
