<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrhPekerjaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drh_pekerjaan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peserta_id');
            $table->foreign('peserta_id')->references('id')->on('tabref_data_peserta')->onDelete('cascade');
            $table->string('instansi');
            $table->string('jabatan');
            $table->date('mulai');
            $table->date('selesai');
            $table->string('gaji_pokok');
            $table->string('sk_nomor');
            $table->date('sk_tanggal');
            $table->string('sk_pejabat_penandatangan');
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
        Schema::dropIfExists('drh_pekerjaan');
    }
}
