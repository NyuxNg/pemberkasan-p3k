<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrhKeteranganLainnyaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drh_keterangan_lainnya', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peserta_id');
            $table->foreign('peserta_id')->references('id')->on('tabref_data_peserta')->onDelete('cascade');
            $table->enum('nama', ['a. skck','b. sks_jasroh','c. skb_napza','d. lainnya'])->unique();
            $table->string('nomor', 100);
            $table->date('tanggal');
            $table->string('pejabat');
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
        Schema::dropIfExists('drh_keterangan_lainnya');
    }
}
