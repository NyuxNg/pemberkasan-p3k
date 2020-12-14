<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrhPenghargaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drh_penghargaan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peserta_id');
            $table->foreign('peserta_id')->references('id')->on('tabref_data_peserta')->onDelete('cascade');
            $table->string('nama');
            $table->string('sk_nomor');
            $table->date('sk_tanggal');
            $table->year('tahun_perolehan');
            $table->string('instansi_pemberi');
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
        Schema::dropIfExists('drh_penghargaan');
    }
}
