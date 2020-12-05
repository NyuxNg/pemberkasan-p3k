<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemberkasanBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemberkasan_berkas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peserta_id');
            $table->foreign('peserta_id')->references('id')->on('tabref_data_peserta')->onDelete('cascade');
            $table->uuid('jberkas_id');
            $table->foreign('jberkas_id')->references('id')->on('tabref_jenis_berkas')->onDelete('cascade');
            $table->string('file');
            $table->enum('status', ['Proses', 'Ditolak', 'Diterima'])->default('Proses');
            $table->text('keterangan');
            $table->uuid('verifikator_id')->nullable();
            $table->foreign('verifikator_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('pemberkasan_berkas');
    }
}
