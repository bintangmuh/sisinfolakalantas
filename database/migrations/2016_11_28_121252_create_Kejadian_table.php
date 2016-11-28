<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKejadianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kejadian', function (Blueprint $table) {
            $table->increments('id');

            $table->boolean('verif'); 
            $table->integer('verifikator_id'); //verifikator polri
            $table->integer('sender_id'); //pengirim berita
            $table->datetime('waktu_kejadian');

            $table->decimal('longitude', 10, 7);
            $table->decimal('latitude', 10, 7);

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
        Schema::dropIfExists('kejadian');
    }
}
