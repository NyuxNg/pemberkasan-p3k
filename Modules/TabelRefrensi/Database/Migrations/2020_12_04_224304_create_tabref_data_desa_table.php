<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabrefDataDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabref_data_desa', function (Blueprint $table) {
            $table->char('id', 10)->primary();
            $table->string('nama'); 
            $table->char('kecamatan_id', 7)->nullable();
            $table->foreign('kecamatan_id')->references('id')->on('tabref_data_kecamatan')->onDelete('cascade');
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
        Schema::dropIfExists('tabref_data_desa');
    }
}
