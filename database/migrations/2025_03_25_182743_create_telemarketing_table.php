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
        Schema::create('telemarketing', function (Blueprint $table) {
            $table->id();
            $table->timestamp('data');
            $table->string('cliente');
            $table->string('telefone');
            $table->date('agendamento');
            $table->time('hora');
            $table->integer('teles');
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_funcionario');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('telemarketing');
    }
};
