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
        Schema::create('komentarfoto', function (Blueprint $table) {
            $table->id('KomentarID');
            $table->unsignedBigInteger('FotoID');
            $table->unsignedBigInteger('UserID');
            $table->text('IsiKomentar');
            $table->date('TanggalKomentar');

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
        Schema::dropIfExists('komentarfoto');
    }
};
