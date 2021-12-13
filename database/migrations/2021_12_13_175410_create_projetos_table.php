<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
    '',
    '',
    '',
    '',
    '',
    'url_video',
    'url_foto',
     */
    public function up()
    {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', '400');
            $table->string('instituicao', '100');
            $table->string('cidade', '100');
            $table->string('coordenador', '100');
            $table->string('resumo', '500');
            $table->string('url_video', '100');
            $table->string('url_foto', '100');
            $table->string('ano', '5')->default('2021');
            $table->text('bolsistas')->nullable();
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
        Schema::dropIfExists('projetos');
    }
}
