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
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data');
            $table->unsignedBigInteger('id_funcionario');
            $table->string('cliente');
            $table->string('telefone');
            $table->boolean('matricula')->nullable();
            $table->string('observacao')->nullable();
            $table->softDeletes();

            $table->unsignedBigInteger('id_midia');
            $table->foreign('id_midia')->references('id')->on('midias')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_funcionario')->references('id')->on('funcionarios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('atendimentos');
    }
};
