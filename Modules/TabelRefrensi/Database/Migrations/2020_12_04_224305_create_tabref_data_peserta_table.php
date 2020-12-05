<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabrefDataPesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabref_data_peserta', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_peserta', 16);
            $table->string('nama');
            $table->char('kab_kota_id', 4)->nullable();
            $table->foreign('kab_kota_id')->references('id')->on('tabref_data_kabupaten')->onDelete('cascade');
            $table->date('tanggal_lahir');
            $table->string('pendidikan');
            $table->string('unit_penempatan');
            $table->string('jabatan');
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
        Schema::dropIfExists('tabref_data_peserta');
    }
}
