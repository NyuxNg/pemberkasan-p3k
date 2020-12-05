<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaperLainnyaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daper_lainnya', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peserta_id');
            $table->foreign('peserta_id')->references('id')->on('tabref_data_peserta')->onDelete('cascade');
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->enum('agama', ['Islam', 'Hindu', 'Budha', 'Kristen', 'Katholik'])->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Janda / Duda'])->nullable();
            $table->string('ijazah_nomor')->nullable();
            $table->date('ijazah_tanggal')->nullable();
            $table->string('ijazah_prodi')->nullable();
            $table->string('skck_pejabat')->nullable();
            $table->string('skck_nomor')->nullable();
            $table->date('skck_tanggal')->nullable();
            $table->string('suket_sehat_pejabat')->nullable();
            $table->string('suket_sehat_nomor')->nullable();
            $table->date('suket_sehat_tanggal')->nullable();
            $table->string('suket_napza_pejabat')->nullable();
            $table->string('suket_napza_nomor')->nullable();
            $table->date('suket_napza_tanggal')->nullable();
            $table->text('keterangan_lainnya')->nullable();
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
        Schema::dropIfExists('daper_lainnya');
    }
}
