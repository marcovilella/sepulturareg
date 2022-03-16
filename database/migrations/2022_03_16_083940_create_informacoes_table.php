<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacaos', function (Blueprint $table) {
            $table->id();
            $table->string('cemiterio')->nullable();
            $table->string('quadra')->nullable();
            $table->string('jazigo')->nullable();
            $table->string('nome_permissionario');
            $table->string('permissionario_vivo', 5);
            $table->string('manutencao_permissao_jazigo', 5);
            $table->unsignedBigInteger('user_id');
        });

        Schema::table('informacaos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informacaos');
    }
}
