<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrhKeteranganPeroranganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drh_keterangan_perorangan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peserta_id');
            $table->foreign('peserta_id')->references('id')->on('tabref_data_peserta')->onDelete('cascade');
            $table->char('nik', 16);
            $table->string('nama');
            $table->char('tempat_lahir_id', 4);
            $table->foreign('tempat_lahir_id')->references('id')->on('tabref_data_kabupaten')->onDelete('cascade');
            $table->date('tanggal_lahir');
            $table->enum('jk', ['L', 'P']);
            $table->enum('agama', ['Islam', 'Hindu', 'Budha', 'Kristen', 'Katholik']);
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Janda / Duda']);
            $table->string('email')->nullable();
            $table->string('no_hp');
            $table->char('provinsi_id', 2);
            $table->foreign('provinsi_id')->references('id')->on('tabref_data_provinsi')->onDelete('cascade');
            $table->char('kabupaten_id', 4);
            $table->foreign('kabupaten_id')->references('id')->on('tabref_data_kabupaten')->onDelete('cascade');
            $table->char('kecamatan_id', 7);
            $table->foreign('kecamatan_id')->references('id')->on('tabref_data_kecamatan')->onDelete('cascade');
            $table->char('desa_id', 10);
            $table->foreign('desa_id')->references('id')->on('tabref_data_desa')->onDelete('cascade');
            $table->text('jalan')->nullable();
            $table->string('tinggi_badan',5)->nullable();
            $table->string('berat_badan',5)->nullable();
            $table->string('rambut',25)->nullable();
            $table->string('bentuk_muka',25)->nullable();
            $table->string('warna_kulit',25)->nullable();
            $table->string('ciri_khas',25)->nullable();
            $table->string('cacat_tubuh',25)->nullable();
            $table->string('kegemaran', 50)->nullable();
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
        Schema::dropIfExists('drh_keterangan_perorangan');
    }
}
