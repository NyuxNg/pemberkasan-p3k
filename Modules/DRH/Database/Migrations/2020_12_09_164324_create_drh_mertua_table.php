<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrhMertuaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drh_mertua', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peserta_id');
            $table->foreign('peserta_id')->references('id')->on('tabref_data_peserta')->onDelete('cascade');
            $table->string('nik', 16);
            $table->string('nip', 18)->nullable();
            $table->string('nama');
            $table->char('tempat_lahir_id', 4);
            $table->foreign('tempat_lahir_id')->references('id')->on('tabref_data_kabupaten')->onDelete('cascade');
            $table->date('tanggal_lahir');
            $table->string('pekerjaan')->nullable();
            $table->string('pekerjaan_tempat')->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Janda / Duda']);
            $table->enum('status_hidup', ['Hidup', 'Meninggal']);
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
        Schema::dropIfExists('drh_mertua');
    }
}
