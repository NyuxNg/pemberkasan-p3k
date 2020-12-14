<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrhPendidikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drh_pendidikan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('peserta_id');
            $table->foreign('peserta_id')->references('id')->on('tabref_data_peserta')->onDelete('cascade');
            $table->enum('tingkat', ['SD', 'SMP', 'SMA', 'D-I', 'D-II', 'D-III', 'D-IV', 'S-1', 'S-2', 'S-3', 'Prof']);
            $table->string('nama_lembaga');
            $table->string('akreditasi')->nullable();
            $table->char('tempat_id', 4);
            $table->foreign('tempat_id')->references('id')->on('tabref_data_kabupaten')->onDelete('cascade');
            $table->string('ijazah_nomor');
            $table->string('ijazah_tanggal');
            $table->string('ijazah_pejabat');
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
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
        Schema::dropIfExists('drh_pendidikan');
    }
}
