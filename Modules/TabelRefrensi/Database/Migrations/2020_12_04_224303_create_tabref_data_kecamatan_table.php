<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabrefDataKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabref_data_kecamatan', function (Blueprint $table) {
            $table->char('id', 7)->primary();
            $table->string('nama'); 
            $table->char('kabupaten_id', 4)->nullable();
            $table->foreign('kabupaten_id')->references('id')->on('tabref_data_kabupaten')->onDelete('cascade');
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
        Schema::dropIfExists('tabref_data_kecamatan');
    }
}
