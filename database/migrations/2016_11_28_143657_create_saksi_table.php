<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saksi', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('kejadian_id');
            $table->string('name');
            $table->integer('umur');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nomor_id');

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
        Schema::dropIfExists('saksi');
    }
}
