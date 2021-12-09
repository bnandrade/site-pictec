<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisoSetorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aviso_setor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aviso_id')->unsigned()->references('id')->on('avisos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('setor_id')->unsigned()->references('id')->on('setores')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('aviso_setor');
    }
}
