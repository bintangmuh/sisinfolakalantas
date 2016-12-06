<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKorbanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korban', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nama');
            $table->integer('umur');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nomorid'); //identitas
            $table->string('kondisi'); //kondisi korban, meninggal, luka parah, luka ringan, selamat tanpa luka
            $table->integer('kabupaten_id');
            $table->integer('kendaraan_id');

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
        Schema::dropIfExists('korban');
    }
}
