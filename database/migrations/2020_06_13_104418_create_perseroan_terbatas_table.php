<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerseroanTerbatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perseroan_terbatas', function (Blueprint $table) {
            $table->id();
            $table->string('ktp');
            $table->string('npwp_pribadi');
            $table->string('legalitas_badan_hukum')->nullable();
        
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
        Schema::dropIfExists('perseroan_terbatas');
    }
}
