<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabrefDataKabupatenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabref_data_kabupaten', function (Blueprint $table) {
            $table->char('id', 4)->primary();
            $table->string('nama'); 
            $table->char('provinsi_id', 2)->nullable();
            $table->foreign('provinsi_id')->references('id')->on('tabref_data_provinsi')->onDelete('cascade');
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
        Schema::dropIfExists('tabref_data_kabupaten');
    }
}
