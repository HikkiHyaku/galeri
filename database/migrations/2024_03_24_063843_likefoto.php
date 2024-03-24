<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likefoto', function (Blueprint $table) {
            $table->id('LikeID');
            $table->unsignedBigInteger('FotoID');
            $table->unsignedBigInteger('UserID');
            $table->date('TanggalLike');

            $table->foreign('FotoID')->references('FotoID')->on('foto');
            $table->foreign('UserID')->references('UserID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likefoto');
    }
};
