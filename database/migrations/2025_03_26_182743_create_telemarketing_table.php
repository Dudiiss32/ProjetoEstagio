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
            $table->string('funcionario');
            $table->string('mes');
            $table->timestamp('data');
            $table->string('cliente');
            $table->string('telefone');
            $table->string('curso');
            $table->date('agendamento');
            $table->time('hora');
            $table->integer('teles');
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
